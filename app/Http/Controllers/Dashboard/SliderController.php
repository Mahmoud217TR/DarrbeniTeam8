<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Resources\SliderResource;
use App\Models\Slider;

use illuminate\Support\Str;
use Illuminate\Http\Request;

class SliderController extends Controller
{


    public function index()
    {

        $sliders = Slider::all();

        return  view('dashboard.pages.slider.index', compact('sliders'));
    }
    public function create()
    {
        return  view('dashboard.pages.slider.form');
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
            return redirect()->route('slider.index')->with('slider  created successfully'); // You should define a successResponse method
        } else {
            return redirect()->route('slider.index')->with('slider Can Not Create');
        }
    }


    public function show($uuid)
    {
        $slider = Slider::where('uuid', $uuid)->first();

        return  view('dashboard.pages.slider.show', compact('slider'));
    }


    public function edit($uuid)
    {
        $slider = Slider::where('uuid', $uuid)->first();

        return  view('dashboard.pages.slider.edit', compact('slider'));
    }
    public function update(SliderRequest $request, $uuid)
    {
        $slider = Slider::where('uuid', $uuid)->first();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/Collage', $imageName);
            $slider->image = $imagePath;
        }

        $slider->link = $request->link;
        $slider->save();

        return redirect()->route('slider.index')->with('slider  Update successfully');
    }
    public function destroy($uuid)
    {
        $slider = Slider::where('uuid', $uuid)->first();


        $slider->delete();
     
        return redirect()->back();
    }



    public function showsoft()
    {
        $sliders = Slider::onlyTrashed()->get();
        return view('dashboard.pages.slider.recycleBin', compact('sliders'));
    }
    public function restor($uuid)
    {
        Slider::withTrashed()->where('uuid', $uuid)->restore();
        return redirect()->back();
    }


    public function finaldelete($uuid)
    {
        $slider = Slider::withTrashed()->where('uuid', $uuid)->first();

   
        $slider->forceDelete();

        return redirect()->back();
    }
}
