<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Spacialization;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    use ApiResponseTrait;

  
    public function index()
    {
        $courses = CourseResource::collection(Course::all());
        return $this->indexResponse($courses);
    }

    public function store(CourseRequest $request)
    {
        $specialization = Spacialization::where('name', $request->specialization_name)->first();

        if (!$specialization) {
            return $this->notfoundResponse('Specialization Not Found');
        }

        $course = Course::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'spacialization_id' => $specialization->id,
        ]);

        return $this->storeResponse(new CourseResource($course));
    }

    public function show($uuid)
    {
        $course = Course::where('uuid', $uuid)->first();

        if ($course) {
            return $this->showResponse(new CourseResource($course));
        }

        return $this->notfoundResponse('Course Not Found');
    }

    public function update(CourseRequest $request, $uuid)
    {
        $specialization = Spacialization::where('name', $request->specialization_name)->first();

        if (!$specialization) {
            return $this->notfoundResponse('Specialization Not Found');
        }

        $course = Course::where('uuid', $uuid)->first();

        if (!$course) {
            return $this->notfoundResponse('Course Not Found');
        }

        $course->update([
            'name' => $request->name,
            'spacialization_id' => $specialization->id,
        ]);

        return $this->updateResponse(new CourseResource($course));
    }

    public function destroy($uuid)
    {
        $course = Course::where('uuid', $uuid)->first();

        if ($course) {
            $course->delete();
            return $this->destroyResponse();
        }

        return $this->errorResponse('Course not found', 400);
    }

      
public function showTrash()
{
    $Courses = Course::onlyTrashed()->get();
    $data=[];
    foreach($Courses as $Course){
        $data[]=[
            'id' => $Course->uuid,
            'name' => $Course->name
        ];
    }
  
        return $this->showResponse($data);
    
}
public function restore($uuid)
{
    $Course = Course::onlyTrashed()->where('uuid',$uuid)->first();
    if(!$Course){
        return $this->notfoundResponse('Course Not Found' );

    }
    $Course->restore();
  
    return $this->successResponse('Success Restore');
    
}

public function foreceDelete($uuid)
{
    $Course = Course::onlyTrashed()->where('uuid',$uuid)->first();
    if(!$Course ){
        return $this->notfoundResponse('Course Not Found' );
    }
    $Course->forceDelete();

    return $this->successResponse('Success Restore');
    
}
    
}
