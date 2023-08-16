<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Spacialization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    public function index()
    {

        $courses = CourseResource::collection(Course::all());
        return $this->apiResponse('data all Course', '', $courses);
    }
    public function store(CourseRequest $request)
    {

        $specialization = Spacialization::where('name', $request->specialization_name)->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($imagePath = $image->storeAs('courses_images', 'public')) {
                $imageName = $request->name . '.' . $image->extension();
                $newPath = 'public/courses_images/' . $imageName;


                $course = Course::create([
                    'uuid' => Str::uuid(),

                    'name' => $request->name,
                    'image' => $newPath,
                    'spacialization_id' => $specialization->id,
                ]);
                $data = [
                    'specialization_name' => $specialization->name,
                    new CourseResource($course)
                ];
                return $this->successResponse('the Course  Save', $data);
            } else {
                return $this->errorResponse('can not uploud Image', 404);
            }
        }
    }
    public function show($id)
    {
        $course = Course::find($id);

        if ($course) {
            $data = [
                'specialization_name' => $course->specializations->name,
                new  CourseResource($course)
            ];
            return $this->successResponse(null, $data);
        }
        return $this->errorResponse('the Course Not Found');
    }
    public function update(CourseRequest $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return $this->errorResponse('the course Not Found', 404);
        }


        $course->update([
            'name' => $request->course_name,

        ]);

        if ($course) {
            return $this->successResponse('the course update', new CourseResource($course));
        }

        return $this->errorResponse('you con not update the course ', 404);
    }
    public function destroy($id)
    {
        $Course = Course::find($id);


        $Course->delete();
        if ($Course) {
            return $this->successResponse('the Course deleted', null);
        }
        return $this->errorResponse('you con not delete the Course', 400);
    }
}
