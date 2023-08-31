<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollageRequest;
use App\Models\Category;
use App\Models\Collage;

use Illuminate\Http\Request;
use illuminate\Support\Str;


class CollageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $collages = Collage::with('category')->get();



        return  view('dashboard.pages.collages.index', compact('collages'));
    }
    public function create()
    {
        $category = Category::all();
        return view('dashboard.pages.collages.form', compact('category'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CollageRequest $request)
    {
        //
        $category = Category::where('id', $request->category_id)->first();


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('storage/Collage', $imageName);


            $collage = collage::create([
                'uuid' => Str::uuid(),
                'image' => $imagePath,
                'name' => $request->name,
                'category_id' => $category->id
            ]);




            return redirect()->route('collage.index')->with('Collage  created successfully');
        } else {
            return  redirect()->with('can not upload Image');
        }
    }



    public function show($uuid)
    {
        // Find the college with the provided ID


        $Collage = Collage::with('category')->where('uuid', $uuid)->first();

        return view('dashboard.pages.collages.show', compact('Collage'));
    }


    public function edit($uuid)
    {
        $category = Category::all();

        $collage = Collage::where('uuid', $uuid)->first();

        return view('dashboard.pages.collages.edit', compact('collage','category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CollageRequest $request, $uuid)
    {

        $category = Category::where('id', $request->category_id)->first();
        $collage = Collage::where('uuid', $uuid)->first();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('storage/Collage', $imageName);


            $collage->update([
                'image' => $imagePath,
                'name' => $request->input('name', $collage->name) ?: $collage->name,
                'category_id' => $category->id ?: $collage->category_id



            ]);




            return redirect()->route('collage.index')->with('Collage  updated successfully');
        } else {
            return  redirect()->route('collage.index')->with('can not upload Image');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $collage = collage::where('uuid', $uuid)->first();
       
            $collage->delete();
            return redirect()->back();
        }
    
    
    
        public function showsoft()
        {
            $collages = collage::onlyTrashed()->get();
            return view('dashboard.pages.collages.recycleBin', compact('collages'));
        }
        public function restor($uuid)
        {
            collage::withTrashed()->where('uuid', $uuid)->restore();
            return redirect()->back();
        }
    
    
        public function finaldelete($uuid)
        {
            $collage = collage::withTrashed()->where('uuid', $uuid)->first();
    
       
            $collage->forceDelete();
    
            return redirect()->back();
        }
    }
    