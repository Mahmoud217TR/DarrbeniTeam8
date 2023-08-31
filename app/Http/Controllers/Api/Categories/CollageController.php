<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollageRequest;
use App\Models\Category;
use App\Models\Collage;
use App\Traits\ApiResponseTrait;
use App\Traits\ImagePathTrait;
use Illuminate\Http\Request;
use illuminate\Support\Str;


class CollageController extends Controller
{
    use ApiResponseTrait;
    use ImagePathTrait;

    public function index()
    {
        try {
            $collages = Collage::with('category')->get();

            $data = [];

            foreach ($collages as $collage) {
                $imagePath = $this->getCollageImagePath($collage->image);

                $data[] = [
                    'uuid' => $collage->uuid,
                    'name' => $collage->name,
                    'image' => $imagePath,
                    'category_name' => $collage->category->name,
                ];
            }

            return $this->indexResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse("Failed to retrieve collages", 500);
        }
    }

    public function store(CollageRequest $request)
    {
        $category = Category::where('name', $request->category_name)->first();

        if (!$category) {
            return $this->notfoundResponse('Category Not Found');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $this->uploadImageAndGetPath($image);

            $collage = Collage::create([
                'uuid' => Str::uuid(),
                'image' => $imagePath,
                'name' => $request->name,
                'category_id' => $category->id,
            ]);

            $data = [
                'name' => $collage->name,
                'image' => $collage->image,
                'category_name' => $collage->category->name,
            ];

            return $this->storeResponse($data);
        } else {
            return $this->errorResponse('Cannot upload image', 404);
        }
    }

    public function show($uuid)
    {
        $colleges = Collage::with('spacializations')->where('uuid', $uuid)->first();

        if (!$colleges) {
            return $this->notfoundResponse('College Not Found');
        }

        $imagePath = $this->getCollageImagePath($colleges->image);

        $specializations = $colleges->spacializations->map(function ($specialization) {
            return [
                'Specialization_name' => $specialization->name,
                'Specialization_id' => $specialization->uuid,
            ];
        });

        $data = [
            'name' => $colleges->name,
            'image' => $imagePath,
            'category_name' => $colleges->category->name,
            'specializations' => $specializations,
        ];

        return $this->showResponse($data);
    }

    public function update(CollageRequest $request, $uuid)
    {
        $category = Category::where('name', $request->category_name)->first();
        $collage = Collage::where('uuid', $uuid)->first();

        if (!$collage) {
            return $this->errorResponse('Collage not found', 404);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $this->uploadImageAndGetPath($image);

            $collage->update([
                'image' => $imagePath,
                'name' => $request->input('name', $collage->name),
                'category_id' => $category->id ?? $collage->category_id,
            ]);
        } else {
            $collage->update([
                'name' => $request->input('name', $collage->name),
                'category_id' => $category->id ?? $collage->category_id,
            ]);
        }

        $data = [
            'name' => $collage->name,
            'image' => $collage->image,
        ];

        return $this->successResponse($data);
    }

    public function destroy($uuid)
    {
        $collage = Collage::where('uuid', $uuid)->first();

        if ($collage) {
            $collage->delete();
            return $this->showResponse("Collage deleted successfully");
        } else {
            return $this->notfoundResponse("Collage not found");
        }
    }

   

    
public function showTrash()
{
    $Collages = Collage::onlyTrashed()->get();
    $data=[];
    foreach($Collages as $Collage){
        $data[]=[
            'id' => $Collage->uuid,
            'name' => $Collage->name
        ];
    }
  
        return $this->showResponse($data);
    
}
public function restore($uuid)
{
    $Collage = Collage::onlyTrashed()->where('uuid',$uuid)->first();
    if(!$Collage ){
        return $this->notfoundResponse('Collage Not Found' );

    }
    $Collage->restore();
  
    return $this->successResponse('Success Restore');
    
}

public function foreceDelete($uuid)
{
    $Collage = Collage::onlyTrashed()->where('uuid',$uuid)->first();
    if(!$Collage ){
        return $this->notfoundResponse('Collage Not Found' );
    }
    $Collage->forceDelete();

    return $this->successResponse('Success Restore');
    
}
}
