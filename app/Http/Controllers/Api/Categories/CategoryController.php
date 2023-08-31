<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use illuminate\Support\Str;


class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $categories = Category::all();
        $allCategories = [];

        foreach ($categories as $category) {
            $allCategories[] = [
                'id' => $category->uuid,
                'name' => $category->name,
            ];
        }

        return $this->indexResponse($allCategories);
    }

    public function getAll()
    {
        $baseImageUrl = config('image.base_url');
        $categories = Category::with('collages')->get();
        $allCategories = [];

        foreach ($categories as $category) {
            $collagesData = [];

            foreach ($category->collages as $collage) {
                $publicPath = str_replace(url('/'), '', $collage->image);
                $storagePath = str_replace('public/', '', $publicPath);
                $imagePath = $baseImageUrl . $storagePath;

                $collagesData[] = [
                    'collage_id' => $collage->uuid,
                    'name' => $collage->name,
                    'image' => $imagePath,
                ];
            }

            $allCategories[] = [
                'category_name' => $category->name,
                'collages' => $collagesData,
            ];
        }

        return $this->showResponse($allCategories);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'uuid' => Str::uuid(),
            'name' => $request->input('name'),
        ]);

        $data = [
            'name' => $category->name,
        ];

        return $this->storeResponse($data);
    }

    public function show($uuid)
    {
        try {
            $baseImageUrl = config('image.base_url');
            $category = Category::with('collages')->where('uuid', $uuid)->firstOrFail();

            $collageData = [];

            foreach ($category->collages as $collage) {
                $publicPath = str_replace(url('/'), '', $collage->image);
                $storagePath = str_replace('public/', '', $publicPath);
                $imagePath = $baseImageUrl . $storagePath;
    
                $collageData[] = [
                    'id' => $collage->uuid,
                    'name' => $collage->name,
                    'image' => $imagePath,
                ];
            }

            $categoryData = [
                'id' => $category->uuid,
                'name' => $category->name,
                'collages' => $collageData,
            ];

            return $this->showResponse($categoryData);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Category not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(CategoryRequest $request, $uuid)
    {
        try {
            $category = Category::where('uuid', $uuid)->firstOrFail();

            $category->update([
                'name' => $request->input('name', $category->name),
            ]);

            $data = [
                'name' => $category->name,
            ];

            return $this->updateResponse($data);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Category not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($uuid)
    {
        $category = Category::where('uuid', $uuid)->first();

        if ($category) {
            $category->delete();
            return $this->showResponse('Category and associated collages deleted successfully');
        } else {
            return $this->notFoundResponse('Category Not Found');
        }
    }

     
public function showTrash()
{
    $Categorys = Category::onlyTrashed()->get();
    $data=[];
    foreach($Categorys as $Category){
        $data[]=[
            'id' => $Category->uuid,
            'name' => $Category->name
        ];
    }
  
        return $this->showResponse($data);
    
}
public function restore($uuid)
    {
        try {
            $Category = Category::onlyTrashed()->where('uuid',$uuid)->firstOrFail();
            $Category->restore();

            return $this->successResponse('Success Restore');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Category not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function forceDelete($uuid)
    {
        try {
            $Category = Category::onlyTrashed()->where('uuid',$uuid)->firstOrFail();
            $Category->forceDelete();

            return $this->successResponse('Success Force Delete');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Category not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
