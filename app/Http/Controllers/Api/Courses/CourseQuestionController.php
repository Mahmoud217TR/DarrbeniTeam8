<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseQuestionRequest;
use App\Http\Resources\CourseQuestionResource;
use App\Models\Course;
use App\Models\CourseAnswerQuestion;
use App\Models\CourseQuestion;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Foreach_;

class CourseQuestionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $questions = CourseQuestion::all();
        $questionArray = [];

        foreach ($questions as $question) {
            $questionArray[] = [
                'question' => $question->question,
                'course' => $question->course->name
            ];
        }

        return $this->indexResponse($questionArray);
    }

    public function store(CourseQuestionRequest $request)
    {
        $course = Course::where('name', $request->course_name)->first();

        if (!$course) {
            return $this->notfoundResponse('Course Not Found');
        }

        $courseQuestion = CourseQuestion::create([
            'uuid' => Str::uuid(),
            'question' => $request->question,
            'course_id' => $course->id,
        ]);

        $courseQuestion->reference()->create([
            'uuid' => Str::uuid(),
            'reference' => $request->reference,
        ]);

        return $this->storeResponse(new CourseQuestionResource($courseQuestion));
    }

    public function show($uuid)
    {
        $question = CourseQuestion::where('uuid', $uuid)->first();

        if ($question) {
            $data = [
                'reference' => $question->reference->reference,
                new CourseQuestionResource($question)
            ];

            return $this->showResponse($data);
        }

        return $this->notfoundResponse('Question Not Found');
    }

    
    public function update(CourseQuestionRequest $request, $uuid)
    {
        $question = CourseQuestion::where('uuid', $uuid)->first();

        if (!$question) {
            return $this->notfoundResponse('Question Not Found');
        }

        $course = Course::where('name', $request->course_name)->first();

        $question->update([
            'uuid' => $question->uuid,
            'question' => $request->question,
            'course_id' => $course->id,
        ]);

        $question->reference()->update([
            'reference' => $request->reference,
        ]);

        return $this->updateResponse(new CourseQuestionResource($question));
    }

    public function destroy($uuid)
{
    $question = CourseQuestion::where('uuid', $uuid)->first();

    if ($question) {
        $question->reference()->delete();
        $question->delete();
        return $this->destroyResponse();
    }
    return $this->errorResponse('Question not found', 400);
}

public function showTrash()
{
    $questions = CourseQuestion::onlyTrashed()->get();
    $data=[];
    foreach($questions as $question){
        $data[]=[
            'id' => $question->uuid,
            'question' => $question->question
        ];
    }
  
        return $this->showResponse($data);
    
}
public function restore($uuid)
{
    $question = CourseQuestion::onlyTrashed()->where('uuid',$uuid)->first();
    if(!$question ){
        return $this->notfoundResponse('Question Not Found' );

    }
    $question->restore();
  
    return $this->successResponse('Success Restore');
    
}
public function foreceDelete($uuid)
{
    $CourseQuestion = CourseQuestion::onlyTrashed()->where('uuid',$uuid)->first();
    if(!$CourseQuestion ){
        return $this->notfoundResponse('CourseQuestion Not Found' );
    }
    $CourseQuestion->forceDelete();

    return $this->successResponse('Success Restore');
    
}



}
