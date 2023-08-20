<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollageRequest;
use App\Models\Category;
use App\Models\Collage;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use illuminate\Support\Str;


class CollageController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
            $collages = Collage::with('category')->get();
           if($collages){
            $data = [];
            foreach ($collages as $collage) {
                $data[] = [
                    'uuid' => $collage->uuid,
                    'name' => $collage->name,
                    'image' => $collage->image,
                    'category_name' => $collage->category->name,
                ];
            }
    
            return $this->indexResponse($data);
        } else{
            // Handle the exception and provide an error response
            return $this->errorResponse("Failed to retrieve collages");
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollageRequest $request)
    {
        //
        $category = Category::where('name', $request->category_name)->first();

        if (!$category) {
            return $this->notfoundResponse('category Not Found');
        }else{
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


                $data = [
                    'name' => $collage->name,
                    'image' => $collage->image,
                    'category_name' => $collage->Category->name
                ];

                return $this->storeResponse($data);
            } else {
                return $this->errorResponse('can not uploud Image', 404);
            }
        }
    }
    

  
    public function show($uuid)
{
    // Find the college with the provided ID
    $colleges = Collage::with('specialization')->where('uuid', $uuid)->first();    


    // Check if the college was found
    if (!$colleges) {
        return $this->notfoundResponse('The College Not Found');
    }

    // Get category name
    $categoryName = $colleges->category->name;

    // Get specialization names
    $specializationNames = [];
    foreach ($colleges->specialization as $specializations) {
        $specialization[] =
        [
          'Specialization_name' =>  $specializations->name,
          'Specializaion_id' => $specializations->uuid
        ];
    }

    $data = [
        'name' => $colleges->name,
        'category_name' => $categoryName,
        'specializations' => $specialization,
    ];

    // Assuming that you have a method showResponse defined elsewhere
    return $this->showResponse($data);
}

    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(CollageRequest $request, $uuid )
    {
       
    // Find the category by ID
    $category = Category::where('name', $request->category_name)->first();

    $collage = collage::where('uuid',$uuid)->first();

    // Check if the category exists
    if (!$collage) {
        return $this->errorResponse('collage not found', 404);
    }

    // Validate and process image update
    if ($request->hasFile('image')) {
      

        $image = $request->file('image');
        
        $imageName = $image->getClientOriginalName();
        $imagePath = $image->storeAs('storage/Collage', $imageName);
        if (!$imagePath) {
            return $this->errorResponse('Failed to upload image', 500);
        }
        $collage->update([
        'image' => $imagePath,
            'name' => $request->input('name', $collage->name)?:$collage->name,
            'category_id' => $category->id?:$collage->category_id 


            
        ]);
    } else {
        // Update collage name only
        $collage->update([
            'name' => $request->input('name', $collage->name)?:$collage->name, 
            'category_id' => $category->id


        ]);
    }

    // Return a successful response with updated data
    $data = [
        'name' => $collage->name,
        'image' => $collage->image,
    ];

    return $this->successResponse($data); // You should define a successResponse method
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $collage = collage::where('uuid',$uuid)->first();
        if($collage){
            $collage->delete();
    
            return $this->showResponse("collage deleted successfully");
        } else {
            // Handle the exception and provide an error response
            return $this->notfoundResponse(" collage Not Found");
        }
    }
}
