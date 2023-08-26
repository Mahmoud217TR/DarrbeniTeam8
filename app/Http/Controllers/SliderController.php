<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use App\Traits\ApiResponseTrait;
use illuminate\Support\Str;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $baseImageUrl = config('image.base_url');
        $sliders = Slider::all();
        $data = [];
    
        foreach ($sliders as $slider) {
            $publicPath = str_replace(url('/'), '', $slider->image);
            $storagePath = str_replace('public/', '', $publicPath);
            $imagePath = $baseImageUrl . $storagePath;
    
            $data[] = [
                'uuid' => $slider->uuid,
                'image' => $imagePath,
                'link' => $slider->link,
            ];
        }
    
        return $this->indexResponse(($data));
    }
    
   
    public function store(SliderRequest $request)
    {
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $imagePath = $image->storeAs('public/Collage', $imageName);
    
    $slider = Slider::create([
        'uuid' => Str::uuid(),
        'link' => $request->link,
        'image' => $imagePath 
    ]);
}
        if ($slider) {
            return $this->storeResponse(new SliderResource($slider) );
        }
        return $this->errorResponse('the slider Not Save');
    }


    public function show($uuid)
{
    $slider = Slider::where('uuid',$uuid)->first();

    return new SliderResource($slider);
}

    public function destroy($uuid)
    {
        $slider = Slider::where('uuid',$uuid)->first();

        
        $slider->delete();
            if ($slider) {
                return $this->successResponse( 'the slider deleted',null);
            }
            return $this->errorResponse('you con not delete the slider', 400);
        
        
    }
    public function update(SliderRequest $request, $uuid)
{
    $slider = Slider::where('uuid',$uuid)->first();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $imagePath = $image->storeAs('public/Collage', $imageName);
        $slider->image = $imagePath;
    }

    $slider->link = $request->link;
    $slider->save();

    return new SliderResource($slider);
}
}
