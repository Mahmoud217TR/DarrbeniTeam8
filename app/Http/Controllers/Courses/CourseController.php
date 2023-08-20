<?php

namespace App\Http\Controllers\Courses;

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
        return $this->indexResponse( $courses);
    }
    // *********************************************
    // *********************************************
    // *****************Store***********************
    // *********************************************
    // *********************************************
    public function store(CourseRequest $request)
    {

        $specialization = Spacialization::where('name', $request->specialization_name)->first();
        if (!$specialization) {
            return $this->notfoundResponse('specialization Not Found');
        } else {


            $course = Course::create([
                'uuid' => Str::uuid(),

                'name' => $request->name,

                'spacialization_id' => $specialization->id,
            ]);
          
            return $this->storeResponse( new CourseResource($course));
        }
    }
// ***********************************************
// ***********************************************
// *********************Show**********************
// **********************************************
// **********************************************

    public function show($uuid)
    {
        $course = Course::where('uuid', $uuid)->first();

        if ($course) {
         
            return $this->showResponse( new  CourseResource($course));
        }
        return $this->notfoundResponse('the Course Not Found');
    }



    // ******************************************************
    // ******************************************************
    // ***************Update********************************
    // ****************************************************
    // **************************************************
    public function update(CourseRequest $request, $uuid)
    {
        $specialization = Spacialization::where('name', $request->specialization_name)->first();
        if (!$specialization) {
            return $this->notfoundResponse('specialization Not Found');
        } else {
            $course = Course::where('uuid', $uuid)->first();
            if (!$course) {
                return $this->notfoundResponse('the course Not Found');
            }


            $course->update([
                'name' => $request->name,
                'spacialization_id' => $specialization->id,
            ]);

            if ($course) {
                return $this->updateResponse(new CourseResource($course));
            }

            return $this->errorResponse('you con not update the course ', 404);
        }
    }

    // ********************************************8
    // ********************************************
    // *************Delete************************
    // *******************************************
    public function destroy($uuid)
    {
        $Course = Course::where('uuid', $uuid)->first();


        $Course->delete();
        if ($Course) {
            return $this->destroyResponse();
        }
        return $this->errorResponse('you con not delete the Course', 400);
    }
}
