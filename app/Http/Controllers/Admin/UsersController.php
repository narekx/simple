<?php


namespace App\Http\Controllers\Admin;


use App\Helpers\Images_up;
use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index ()
    {
        return view('back.users.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function anyData(){
        return Datatables::of(User::select('*'))->addColumn('action', function ($user) {
            return '<a href="/admin/users/delete/'.$user->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> ջնջել</a>';
        })->editColumn('id', '{{$id}}')
            ->make(true);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy ($id)
    {
        $user = User::findOrFail($id);
        if ($user->profile_photo) {
            $upload = new Images_up();
            $upload->path = User::imagePath();
            $upload->deleteImages($user->profile_photo);
        }
        $user->delete();

        return redirect()->back();
    }
}
