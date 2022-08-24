<?php


namespace App\Http\Controllers\Admin;


use App\Enums\CategoryStatuses;
use App\Helpers\Images_up;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index ()
    {
        return view('back.categories.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create ()
    {
        $statuses = get_class_constants(CategoryStatuses::class);
        $icons = $this->getIcons();
        return view('back.categories.create', compact('statuses', 'icons'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store (Request $request)
    {
        $rules = Category::rules();
        $rules['images'] = 'required';
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator,'category')
                ->withInput();
        }


        $category = new Category();
        $category->name     = $request->name;
        $category->slug     = $request->slug;
        $category->order    = $request->order;
        $category->status   = $request->status;
        $category->icon   = $request->icon;
        if ($request->images) {
            $upload = new Images_up();
            $upload->path = Category::imagePath();
            $images = $upload->upload($request);
            $category->image = $images ? $images[0] : null;
        }

        $category->save();

        return redirect()->route('admin.categories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit ($id)
    {
        $category = Category::where('id', $id)->first();
        if (!$category) {
            return  redirect()->route('admin.categories.index');
        }

        $icons = $this->getIcons();
        $statuses = get_class_constants(CategoryStatuses::class);
        return view('back.categories.edit', compact('category', 'statuses', 'icons'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Request $request, $id)
    {
        $category = Category::where('id', $id)->first();
        if (!$category) {
            return  redirect()->route('admin.categories.index');
        }

        $rules = Category::rules($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator,'category')
                ->withInput();
        }

        $category->name     = $request->name;
        $category->slug     = $request->slug;
        $category->order    = $request->order;
        $category->status   = $request->status;
        $category->icon   = $request->icon;
        if ($request->images) {
            $upload = new Images_up();
            $upload->path = Category::imagePath();
            $images = $upload->upload($request);
            if ($images) {
                $upload->deleteImages($category->image);
                $category->image = $images[0];
            }
        }

        $category->save();

        return redirect()->route('admin.categories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        $category = Category::findOrFail($id);
        if ($category->image) {
            $upload = new Images_up();
            $upload->path = Category::imagePath();
            $upload->deleteImages($category->image);
        }
        $category->delete();

        return redirect()->back();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function anyData(){
        return Datatables::of(Category::select('*')->orderBy('order'))->addColumn('action', function ($cat) {
            return '<a href="/admin/categories/edit/' . $cat->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Խմբագրել</a><a href="/admin/categories/delete/'.$cat->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> ջնջել</a>';
        })->editColumn('id', '{{$id}}')
            ->make(true);
    }

    /**
     * @param Request $request
     */
    public function sortTable(Request $request){
        if ($request->isMethod('get')) {
            $sort_array = $request->sort;
            $Categorie = new Category();
            $Categorie->sortTable($sort_array);
        }
    }

    /**
     * @return array
     */
    private function getIcons ()
    {
        $files = scandir(public_path('/static/img/icons/'));
        $icons = [];
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $icons[] = explode('.', $file)[0];
        }

        return $icons;
    }
}
