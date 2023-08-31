<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use illuminate\Support\Str;


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Category::all();


        return view('dashboard.pages.categories.index', compact('Categories'));
    }

    public function create()
    {
        return view('dashboard.pages.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

    
        $category = Category::create([
            'uuid' => str::uuid(),
            'name' => $request->input('name')
        ]);
        if ($category) {
            return redirect()->route('category.index')->with('Category  created successfully'); // You should define a successResponse method
        } else {
            return redirect()->route('category.index')->with('Category Can Not Create');
        }
    }




    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $category = Category::where('uuid', $uuid)->first();

        return view('dashboard.pages.categories.show', compact('category'));
    }

    public function edit($uuid)
    {
        $category = Category::where('uuid', $uuid)->first();

        return view('dashboard.pages.categories.edit', compact('category'));
    }
    /**
     * Update the specified resource in storage.
     */ public function update(CategoryRequest $request, $uuid)
    {
        // Find the category by ID
        $category = Category::where('uuid', $uuid)->first();
        if ($category) {

            $category->update([
                'name' => $request->input('name', $category->name), // Use input() method for null coalescing
            ]);


            return redirect()->route('category.index')->with('Category  Update successfully'); // You should define a successResponse method
        } else {
            return redirect()->route('category.index')->with('Category Not Found');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $category = Category::where('uuid', $uuid)->first();
     
            $category->delete();

            return redirect()->back();
    }



    public function showsoft()
    {
        $Categories = Category::onlyTrashed()->get();
        return view('dashboard.pages.categories.recycleBin', compact('Categories'));
    }
    public function restor($uuid)
    {
        Category::withTrashed()->where('uuid', $uuid)->restore();
        return redirect()->back();
    }


    public function finaldelete($uuid)
    {
        $category = Category::withTrashed()->where('uuid', $uuid)->first();

   
        $category->forceDelete();

        return redirect()->back();
    }
}
