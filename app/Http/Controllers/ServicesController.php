<?php


namespace App\Http\Controllers;


use App\Enums\CategoryStatuses;
use App\Helpers\Images_up;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Models\Category;
use App\Models\City;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\WeekDay;
use App\Models\WorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index ()
    {
        $services = auth()->user()->services()->get();
        return view('services/index', compact('services'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search ()
    {
        $services = Service::with(['category', 'workTime', 'user' => function ($q) {
            return $q->with('city');
        }]);

        $title = '';

        if (isset($_GET['title']) && $_GET['title']) {
            $title = $_GET['title'];
            $services = $services->where('title', 'like', '%' . $title . '%');
        }
        $workTimes = WorkTime::all(['id', 'name']);
        if (isset($_GET['work_times']) && $_GET['work_times']) {
            $workTimesArray = $_GET['work_times'];
            $services = $services->whereHas('workTime', function ($q) use ($workTimesArray) {
                return $q->whereIn('id', $workTimesArray);
            });

            foreach ($workTimes as &$workTime) {
                $workTime->selected = in_array($workTime->id, $workTimesArray);
            }
        }

        $categories = Category::where('status', CategoryStatuses::ACTIVE)
            ->orderBy('order')
            ->get(['id', 'name']);
        if (isset($_GET['categories']) && $_GET['categories']) {
            $categoriesArray = $_GET['categories'];
            $services = $services->whereHas('category', function ($q) use ($categoriesArray) {
                return $q->whereIn('id', $categoriesArray);
            });

            foreach ($categories as &$category) {
                $category->selected = in_array($category->id, $categoriesArray);
            }
        }

        $weekDays = WeekDay::all(['id', 'name']);
        if (isset($_GET['weekDays']) && $_GET['weekDays']) {
            $weekDaysArray = $_GET['weekDays'];
            $services = $services->whereHas('weekDays', function ($q) use ($weekDaysArray) {
                return $q->whereIn('week_day_id', $weekDaysArray);
            });

            foreach ($weekDays as &$weekDay) {
                $weekDay->selected = in_array($weekDay->id, $weekDaysArray);
            }
        }

        $cities = City::all(['id', 'name']);
        if (isset($_GET['cities']) && $_GET['cities']) {
            $citiesArray = [];
            if (!is_array($_GET['cities'])) {
                $citiesArray[] = $_GET['cities'];
            } else {
                $citiesArray = $_GET['cities'];
            }
            $services = $services->whereHas('user', function ($q) use ($citiesArray) {
                return $q->whereIn('city_id', $citiesArray);
            });

            foreach ($cities as &$city) {
                $city->selected = in_array($city->id, $citiesArray);
            }
        }

        $services = $services
            ->orderBy('updated_at')
            ->paginate(15);

        return view('services.search', compact('services', 'workTimes', 'categories', 'weekDays', 'cities', 'title'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create ()
    {
        $categories = $this->getCategories();
        $workTimes = $this->getWorkTimes();
        $weekDays = $this->getWeekDays();
        return view('services.create', compact('categories', 'workTimes', 'weekDays'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store (Request $request)
    {
        $rules = Service::rules();
        $rules['images'] = 'required';
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data['user_id'] = auth()->id();
        $service = Service::create($data);
        if ($data['images']) {
            $upload = new Images_up();
            $upload->path = ServiceImage::imagePath();
            $images = $upload->upload($request);
            $newImages = [];
            foreach ($images as $image) {
                $newImages[]['name'] = $image;
            }
            $service->images()->createMany($newImages);
        }

        if ($data['week_days']) {
            $service->weekDays()->sync($data['week_days']);
        }

        return redirect()->route('services.edit', ['id' => $service->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit ($id)
    {
        $service = auth()->user()->services()->where('id', $id)->with(['weekDays', 'images'])->first();
        if (!$service) {
            return redirect()->back();
        }

        $categories = $this->getCategories($service->category_id);
        $weekDays = $this->getWeekDays($service->weekDays);
        $workTimes = $this->getWorkTimes($service->work_time_id);

        return view('services.edit', compact('service', 'categories', 'weekDays', 'workTimes'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Request $request, $id)
    {
        $service = auth()->user()->services()->where('id', $id)->with(['weekDays', 'images'])->first();
        if (!$service) {
            return redirect()->back();
        }

        $rules = Service::rules();
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $service->update($data);

        if (isset($data['images']) && $data['images']) {
            $upload = new Images_up();
            $upload->path = ServiceImage::imagePath();
            $images = $upload->upload($request);
            $newImages = [];
            foreach ($images as $image) {
                $newImages[]['name'] = $image;
            }
            $service->images()->createMany($newImages);
        }

        if ($data['week_days']) {
            $service->weekDays()->sync($data['week_days']);
        }

        return redirect()->route('services.edit', ['id' => $service->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy ($id)
    {
        $service = auth()->user()->services()->where('id', $id)->with('images')->first();
        if (!$service) {
            return redirect()->back();
        }
        $images = $service->images;
        $service->delete();
        if ($images && count($images) > 0) {
            $upload = new Images_up();
            $upload->path = ServiceImage::imagePath();
            foreach ($images as $image) {
               $upload->deleteImages($image->name);
           }
        }

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show ($id)
    {
        $service = Service::where('id', $id)
            ->with('category', 'weekDays', 'workTime', 'images')
            ->first();
        if (!$service) {
            return redirect()->route('home');
        }

        return view('services.show', compact('service'));
    }

    /**
     * @param null $id
     * @return mixed
     */
    private function getCategories ($id = null)
    {
        $categories = Category::where('status', CategoryStatuses::ACTIVE)
            ->orderBy('order')
            ->get(['id', 'name']);

        if ($id) {
            foreach ($categories as &$category) {
                $category->selected = $category->id == $id;
            }
        }

        return $categories;
    }

    /**
     * @param null $serviceWeekDays
     * @return WeekDay[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getWeekDays ($serviceWeekDays = null)
    {
        $weekDays = WeekDay::all(['name', 'id']);
        if ($serviceWeekDays) {
            $serviceWeekDays = $serviceWeekDays->pluck('id')->toArray();
            foreach ($weekDays as &$weekDay) {
                $weekDay->selected = in_array($weekDay->id, $serviceWeekDays);
            }
        }

        return $weekDays;
    }

    /**
     * @param null $id
     * @return WorkTime[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getWorkTimes ($id = null)
    {
        $workTimes = WorkTime::all(['name', 'id']);
        if ($id) {
            foreach ($workTimes as &$workTime) {
                $workTime->selected = $workTime->id == $id;
            }
        }

        return $workTimes;
    }
}
