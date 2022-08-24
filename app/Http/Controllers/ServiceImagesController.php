<?php


namespace App\Http\Controllers;


use App\Helpers\Images_up;
use App\Models\ServiceImage;

class ServiceImagesController extends Controller
{
    /**
     * @param $id
     */
    public function destroy ($id)
    {
        $image = ServiceImage::find($id);
        if (!$image) {
            return false;
        }

        $upload = new Images_up();
        $upload->path = ServiceImage::imagePath();
        $upload->deleteImages($image->name);
        $image->delete();
        return true;
    }
}
