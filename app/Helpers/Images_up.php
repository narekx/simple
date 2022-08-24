<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class Images_up{

    public $thumb_width  = 300;
    public $thumb_height = 300;

    public $miny_width  = 100;
    public $miny_height = 100;

    public $image_name = "images";

    public $path = "uploads";

    public function upload(Request $request) {
        $imgs = $request->{$this->image_name};
        $files = [];
        if(!is_array($imgs)){
            $files[] =  $imgs;
        } else {
            $files = $imgs;
        }
        foreach ($files as $key => $file) {
            $image = $file;

            $random_string = md5(microtime());
            $filename  = $random_string.'.'. $image->getClientOriginalExtension();


            $path = public_path($this->path.'/' . $filename);

            Image::make($image->getRealPath())->save($path);


            $filename_thumb  = "thumb_".$filename;
            $path = public_path($this->path.'/' . $filename_thumb);
            Image::make($image->getRealPath())->resize($this->thumb_width, $this->thumb_height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($path);

            $filename_miny  = "miny_".$filename;
            $path = public_path($this->path.'/' . $filename_miny);
            Image::make($image->getRealPath())->resize($this->miny_width, $this->miny_height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($path);
            $images[] = $filename;
        }

        return $images;
    }

    public function deleteImages($images)
    {
        unlink(public_path($this->path.'/'.$images));
        unlink(public_path($this->path.'/miny_'.$images));
        unlink(public_path($this->path.'/thumb_'.$images));
    }
}
