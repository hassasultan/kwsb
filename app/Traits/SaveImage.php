<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SaveImage
{
    /**
     * Set slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function complaintImage($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'complaint/image'.'/'.'img/'.$filenamenew;
        $filename       = $img->move(public_path('storage/complaint/image'.'/'.'img'),$filenamenew);
        return $filenamepath;
    }
    public function MobileAgentImage($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'agent/image'.'/'.'img/'.$filenamenew;
        $filename       = $img->move(public_path('storage/agent/image'.'/'.'img'),$filenamenew);
        return $filenamepath;

    }
    public function before($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'before/image'.'/'.'img/'.$filenamenew;
        $filename       = $img->move(public_path('storage/before/image'.'/'.'img'),$filenamenew);
        return $filenamepath;

    }
    public function after($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'after/image'.'/'.'img/'.$filenamenew;
        $filename       = $img->move(public_path('storage/after/image'.'/'.'img'),$filenamenew);
        return $filenamepath;

    }
}
