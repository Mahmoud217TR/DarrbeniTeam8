<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseQuestionRequest;
use App\Http\Resources\CourseQuestionResource;
use App\Models\Course;
use App\Models\CourseOuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseOuestionController extends Controller
{
    public function index()
    {

        $question = CourseQuestionResource::collection(CourseOuestion::all());
        return $this->apiResponse('data all Question', '', $question);
    }
    public function store(CourseQuestionRequest $request)
    {

        $course = Course::where('name', $request->course_name)->first();



        $course = CourseOuestion::create([
            'uuid' => Str::uuid(),

            'question' => $request->question,

            'course_id' => $course->id,
        ]);
        $data = [
            'course_name' => $course->name,
            new CourseQuestionResource($course)
        ];
        return $this->successResponse('the Course  Save', $data);
    }
    public function show($id)
    {
        $question = CourseOuestion::find($id);

        if ($question) {
            $data = [
                'specialization_name' => $question->specializations->name,
                new  CourseQuestionResource($question)
            ];
            return $this->successResponse(null, $data);
        }
        return $this->errorResponse('the Course Not Found');
    }
    public function update(CourseQuestionRequest $request, $id)
    {
        $question = CourseOuestion::find($id);
        if (!$question) {
            return $this->errorResponse('the course Not Found', 404);
        }


        $question->update([
            'name' => $request->course_name,

        ]);

        if ($question) {
            return $this->successResponse('the course update', new CourseQuestionResource($question));
        }

        return $this->errorResponse('you con not update the course ', 404);
    }
    public function destroy($id)
    {
        $question = CourseOuestion::find($id);


        $question->delete();
        if ($question) {
            return $this->successResponse('the Course deleted', null);
        }
        return $this->errorResponse('you con not delete the Course', 400);
    }
}
