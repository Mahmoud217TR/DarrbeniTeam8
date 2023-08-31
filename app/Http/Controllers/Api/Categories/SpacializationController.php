<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpacializationRequest;
use App\Models\Collage;
use App\Models\Spacialization;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

use illuminate\Support\Str;


class SpacializationController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $spacializations = Spacialization::with('collage')->get();
        
        $data = [];
        foreach ($spacializations as $spacialization) {
            $data[] = [
                'id' => $spacialization->uuid,
                'name' => $spacialization->name,
                'collage_name' => $spacialization->collage->name,
            ];
        }

        return $this->indexResponse($data);
    }

    public function store(SpacializationRequest $request)
    {
        $collage = Collage::where('name', $request->collage_name)->first();

        if (!$collage) {
            return $this->notfoundResponse('Collage Not Found');
        }

        $spacialization = Spacialization::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'collage_id' => $collage->id,
        ]);

        $data = [
            'id' => $spacialization->uuid,
            'name' => $spacialization->name,
            'collage_name' => $collage->name,
        ];

        return $this->storeResponse($data);
    }

    public function show($uuid)
    {
        $specialization = Spacialization::with('courses')->where('uuid', $uuid)->first();

        if (!$specialization) {
            return $this->notfoundResponse('Specialization Not Found');
        }

        $courses = [];
        foreach ($specialization->courses as $course) {
            $courses[] = [
                'course_id' => $course->uuid,
                'course_name' => $course->name,
            ];
        }

        $data = [
            'id' => $specialization->uuid,
            'name' => $specialization->name,
            'collage_name' => $specialization->collage->name,
            'courses' => $courses,
        ];

        return $this->showResponse($data);
    }

    public function update(SpacializationRequest $request, $uuid)
    {
        $collage = Collage::where('name', $request->input('collage_name'))->first();

        if (!$collage) {
            return $this->notfoundResponse('Collage Not Found');
        }

        $spacialization = Spacialization::where('uuid', $uuid)->first();

        if (!$spacialization) {
            return $this->notfoundResponse('Specialization Not Found');
        }

        $spacialization->update([
            'name' => $request->name,
            'collage_id' => $collage->id,
        ]);

        $data = [
            'name' => $spacialization->name,
            'collage_name' => $collage->name,
        ];

        return $this->showResponse($data);
    }

    public function destroy($uuid)
    {
        $spacialization = Spacialization::where('uuid', $uuid)->first();

        if (!$spacialization) {
            return $this->notfoundResponse('Specialization Not Found');
        }

        $spacialization->delete();

        return $this->destroyResponse('Specialization deleted successfully');
    }

    
public function showTrash()
{
    $Spacializations = Spacialization::onlyTrashed()->get();
    $data=[];
    foreach($Spacializations as $Spacialization){
        $data[]=[
            'id' => $Spacialization->uuid,
            'name' => $Spacialization->name
        ];
    }
  
        return $this->showResponse($data);
    
}
public function restore($uuid)
{
    $Spacialization = Spacialization::onlyTrashed()->where('uuid',$uuid)->first();
    if(!$Spacialization ){
        return $this->notfoundResponse('Spacialization Not Found' );

    }
    $Spacialization->restore();
  
    return $this->successResponse('Success Restore');
    
}
public function foreceDelete($uuid)
{
    $Spacialization = Spacialization::onlyTrashed()->where('uuid',$uuid)->first();
    if(!$Spacialization ){
        return $this->notfoundResponse('Spacialization Not Found' );
    }
    $Spacialization->forceDelete();

    return $this->successResponse('Success Restore');
    
}


}
