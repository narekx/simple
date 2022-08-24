<?php


namespace App\Http\Controllers;


use App\Helpers\Images_up;
use App\Models\City;
use App\Models\Region;
use App\Models\ServiceImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showProfile ()
    {
        $user = auth()->user()->with(['city' => function ($q) {
            return $q->with(['region' => function ($q1) {
                return $q1->with('cities');
            }]);
        }])->first();

        $regions = Region::all(['id', 'name']);
        $cities = [];

        if ($user->city && $regions && count($regions) > 0) {
            foreach ($regions as $region) {
                if ($region->id == $user->city->region_id) {
                    $region->selected = true;
                    $cities = $user->city->region->cities;
                }
            }
        }

        if ($user->city && $cities && count($cities) > 0) {
            foreach ($cities as $city) {
                $city->selected = $city->id == $user->city_id;
            }
        }

        return view('users.profile', compact('user', 'regions', 'cities'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile (Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $rules = User::rules($user->id);

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (isset($data['images']) && $data['images']) {
            $upload = new Images_up();
            $upload->path = User::imagePath();
            $images = $upload->upload($request);
            if ($images) {
                $data['profile_photo'] = $images[0];
            }
        }

        $user->update($data);

        return redirect()->route('profile.show');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show ($id)
    {
        $user = User::where('id', $id)
            ->with(['city', 'services' => function ($q) {
                return $q->with(['workTime', 'weekDays', 'images']);
            }])
            ->first();
        if (!$user) {
            return redirect()->route('home');
        }

        return view('users.show', compact('user'));
    }
}
