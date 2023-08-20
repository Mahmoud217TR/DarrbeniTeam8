<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Category::all();
        $all = [];
        foreach($Categories as $Category ){
            $all[] = [
                'id' => $Category->uuid,
                'name' => $Category->name,
                'image' => $Category->image
            ];
        };

        return $this->indexResponse($all);
    }

    public function getAll(){
        
        $categories = Category::with('collages')->get();
        $all =[];
        foreach ($categories as $category) {
            $collagesData = [];

            foreach ($category->collages as $collage) {
                $collagesData[] = [
                    'name' => $collage->name,
                    'image' => $collage->image,
                ];
            }

            $all[] = [
                'category_name' => $category->name,
                'collages' => $collagesData,
            ];
        }
        

        return $this->showResponse($all);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
{
    
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $imagePath = $image->storeAs('public/Category', $imageName);

        $category = Category::create([
            'uuid' => str::uuid(),
            'image' => $imagePath,
            'name' => $request->input('name')
        ]);

        $data = [
            'name' => $category->name,
            'image' => $category->image
        ];

        return $this->storeResponse($data);
    } else {
        $category = Category::create([
            'uuid' => str::uuid(),
            'name' => $request->input('name')
        ]);

        return $this->storeResponse($category->name);
    }
}




    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $category = Category::with('collages')->where('uuid', $uuid)->first();    
        if (!$category) {
            return $this->errorResponse("Category not found", 404);
        }
    
        $collageData = [];
        foreach ($category->collages as $collage) {
            $collageData[] = [
                'name' => $collage->name,
                'image' => $collage->image, // Make sure the attribute name is correct
            ];
        }
    
        $categoryData = [
            'name' => $category->name,
            'image' => $category->image, // Make sure the attribute name is correct
            'collages' => $collageData,
        ];
    
        return $this->showResponse($categoryData);
    }
    
    
    /**
     * Update the specified resource in storage.
     */public function update(CategoryRequest $request, $uuid)
{
    // Find the category by ID
    $category = Category::where('uuid', $uuid)->first();    

    // Check if the category exists
    if (!$category) {
        return $this->errorResponse('Category not found', 404);
    }

    // Validate and process image update
    if ($request->hasFile('image')) {
      

        $image = $request->file('image');
        
        $imageName = $image->getClientOriginalName();
        $imagePath = $image->storeAs('public/Category', $imageName);
        if (!$imagePath) {
            return $this->errorResponse('Failed to upload image', 500);
        }

        // Update category with new image path and name
        $category->update([
            'image' => $imagePath,
            'name' => $request->input('name', $category->name)?:$category->name, // Use input() method for null coalescing
        ]);
    } else {
        // Update category name only
        $category->update([
            'name' => $request->input('name', $category->name), // Use input() method for null coalescing
        ]);
    }

    // Return a successful response with updated data
    $data = [
        'name' => $category->name,
        'image' => $category->image,
    ];

    return $this->successResponse($data); // You should define a successResponse method
}

    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {   
    $category = Category::where('uuid', $uuid)->first();    
        if($category){
            $category->delete();
    
            return $this->showResponse("Category and associated collages deleted successfully");
        } else {
            // Handle the exception and provide an error response
            return $this->notfoundResponse(" Category Not Found");
        }
    }
}
