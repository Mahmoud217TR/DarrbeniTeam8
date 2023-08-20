<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseQuestionRequest;
use App\Http\Resources\CourseQuestionResource;
use App\Models\Course;
use App\Models\CourseQuestion;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseQuestionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        $question = CourseQuestion::all();
        $array=[
            'question'=>$question->question,
            'course'=>$question->course->name
        ];
        return $this->indexResponse($array);
      
    }
    // **********************************************************
    // **********************************************************
    // ***********************Store******************************
    // **********************************************************
    // **********************************************************
    public function store(CourseQuestionRequest $request)
    {
        $course = Course::where('name', $request->course_name)->first();
        if (!$course) {
            return $this->notfoundResponse('course Not Found');
        } else {
        $courseQuestion = CourseQuestion::create([
            'uuid' => Str::uuid(),
            'question' => $request->question,
            'course_id' => $course->id,
        ]);
    
        // Create a reference and associate it with the course question
        $courseQuestion->reference()->create([
            'uuid' => Str::uuid(),

            'reference' =>$request->reference,
        ]);
    
       
    
        return $this->storeResponse( new CourseQuestionResource($courseQuestion));
    }
}
    // ***********************************************
    // ***********************************************
    // ******************Show*************************
    // ***********************************************
    // ***********************************************
    public function show($uuid)
    {
        $question = CourseQuestion::where('uuid',$uuid)->first();

        if ($question) {
            $data = [
                
                'reference'=>$question->references->reference,
                new  CourseQuestionResource($question)
            ];
            return $this->showResponse($data);
        }
        return $this->notfoundResponse('the question Not Found');
    }
    // ********************************************************
    // ********************************************************
    // *******************Update*******************************
    // ********************************************************
    // ********************************************************
    public function update(CourseQuestionRequest $request, $uuid)
    {
        $question = CourseQuestion::where('uuid',$uuid)->first();
        if (!$question) {
            return $this->notfoundResponse('the question Not Found');
        }
        $course = Course::where('name', $request->course_name)->first();


        $question->update([
            'uuid' => Str::uuid(),
            'name' => $request->course_name,
            'course_id' => $course->id,

        ]);
        $question->reference()->update([
            'reference' =>$request->reference,    
        ]);

        if ($question) {
            return $this->updateResponse( new CourseQuestionResource($question));
        }

        return $this->errorResponse('you con not update the question ', 404);
    }
    // ***************************************************
    // ***************************************************
    // *******************Delete**************************
    // ***************************************************
    // ***************************************************
    public function destroy($uuid)
    {
        $question = CourseQuestion::where('uuid',$uuid)->first();


        if ($question) {
        $question->delete();

            return $this->destroyResponse();
        }
        return $this->errorResponse('you con not delete the question', 400);
    }
}
