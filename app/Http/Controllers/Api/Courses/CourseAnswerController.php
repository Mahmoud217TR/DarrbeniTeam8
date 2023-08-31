<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;

use App\Http\Requests\CourseAnswerRequest;
use App\Http\Resources\CourseAnswerResource;
use App\Models\CourseAnswer;
use App\Models\CourseAnswerQuestion;
use App\Models\CourseQuestion;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseAnswerController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $questions = CourseQuestion::with('answers')->get();
        $responseArray = [];

        foreach ($questions as $question) {
            $answers = [];
            foreach ($question->answers as $answer) {
                $answers[] = $answer->answer;
            }
            $responseArray[] = [
                "question" => $question->question,
                "answers" => $answers
            ];
        }
        
        return $this->indexResponse($responseArray);
    }

    public function store(CourseAnswerRequest $request)
    {
        $question = CourseQuestion::where('question', $request->question_name)->first();
        
        if (!$question) {
            return $this->notfoundResponse('Question Not Found');
        } else {
            $answer = CourseAnswer::create([
                'uuid' => Str::uuid(),
                'answer' => $request->answer,
            ]);
            
            $questionAnswer = CourseAnswerQuestion::create([
                'uuid' => Str::uuid(),
                'course_answer_id' => $answer->id,
                'course_question_id' => $question->id,
                'status' => $request->status,
            ]);
            
            $data = [
                'question' => $question->question,
                'answer' => $answer->answer,
                'status' => $questionAnswer->status
            ];

            return $this->storeResponse($data);
        }
    }

    public function show($uuid)
    {
        $question = CourseQuestion::with('answers')->where('uuid', $uuid)->first();

        if ($question) {
            $answers = [];

            foreach ($question->answers as $answer) {
                $answers[] = $answer->answer;
            }

            $data = [
                'question' => $question->question,
                'answer' => $answers
            ];
            
            return $this->showResponse($data);
        }
        
        return $this->notfoundResponse('The question Not Found');
    }

    public function update(CourseAnswerRequest $request, $uuid)
    {
        $answer = CourseAnswer::where('uuid', $uuid)->first();
        
        if (!$answer) {
            return $this->notfoundResponse('The Answer Not Found');
        }
        
        $question = CourseQuestion::where('question', $request->question_name)->first();

        $answer->update([
            'uuid' => $answer->uuid,
            'answer' => $request->answer,
        ]);

        $answer->questions()->detach();
        $answer->questions()->attach($question, ['uuid' => Str::uuid(), 'status' => $request->status]);

        return $this->updateResponse(new CourseAnswerResource($answer));
    }

    public function destroy($uuid)
    {
        $answer = CourseAnswer::where('uuid', $uuid)->first();
        if (!$answer) {
        return $this->errorResponse('you con not delete the Answer', 400);
           
        }
        $answer->delete();

        return $this->destroyResponse();
    }
}
