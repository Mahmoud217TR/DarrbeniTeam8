<?php
namespace App\Traits;

use App\Models\Code;
use App\Models\User;
use Illuminate\Support\Str;


trait ImagePathTrait
{
    protected function getCollageImagePath($image)
    {
        $baseImageUrl = config('image.base_url');
        $publicPath = str_replace(url('/'), '', $image);
        $storagePath = str_replace('public/', '', $publicPath);
        return $baseImageUrl . $storagePath;
    }

    protected function uploadImageAndGetPath($image)
    {
        $imageName = $image->getClientOriginalName();
        return $image->storeAs('public/Collage', $imageName);
    }

     protected function uploadImageAndGetPathSlider($image)
    {
        $imageName = $image->getClientOriginalName();
        return $image->storeAs('public/slider', $imageName);
    }

}