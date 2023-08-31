<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use App\Traits\ApiResponseTrait;
use App\Traits\ImagePathTrait;
use illuminate\Support\Str;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ApiResponseTrait;
    use ImagePathTrait;
    public function index()
    {
        $sliders = Slider::all();
        $data = SliderResource::collection($sliders);

        return $this->indexResponse($data);
    }

    public function store(SliderRequest $request)
    {
   
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $this->uploadImageAndGetPathSlider($image);

         
        }
        $slider = Slider::create([
            'uuid' => Str::uuid(),
            'link' => $request->link,
            'image' => $imagePath,
        ]);

        if ($slider) {
            return $this->storeResponse(new SliderResource($slider));
        }

        return $this->errorResponse('The slider could not be saved', 400);
    }

    public function show($uuid)
    {
        $slider = Slider::where('uuid',$uuid)->first();

        return $this->showResponse(new SliderResource( $slider));
    }

    public function destroy($uuid)
    {
        $slider =  Slider::where('uuid',$uuid)->first();
        $slider->delete();
        return $this->successResponse('The slider has been deleted');
    }

    public function update(SliderRequest $request, $uuid)
    {
        $slider =  Slider::where('uuid',$uuid)->first();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $this->uploadImageAndGetPathSlider($image);
            $slider->image = $imagePath;
        }

        $slider->uuid = $uuid;
        $slider->link = $request->link;
        $slider->save();

        return new SliderResource($slider);
    }

   
}
