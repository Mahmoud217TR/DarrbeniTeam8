<?php

namespace App\Http\Controllers\Courses;

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
        $array = [];

        foreach ($questions as $question) {
            $Answers = [];
            foreach ($question->answers as $Answer) {
                $Answers[] = $Answer->answer;
            }
            $array[] = [
                "question" => $question->question,
                "answers" => $Answers
            ];
        }
        return $this->indexResponse($array);
    }

    // *****************************************************
    // *****************************************************
    // *************************Store************************
    // ******************************************************
    // ******************************************************
    public function store(CourseAnswerRequest $request)
    {
        $question = CourseQuestion::where('question', $request->question_name)->first();
        if (!$question) {
            return $this->notfoundResponse('question Not Found');
        } else {
            $Answer = CourseAnswer::create([
                'uuid' => Str::uuid(),
                'answer' => $request->answer,

            ]);
            $questionAnswer = CourseAnswerQuestion::create([
                'uuid' => Str::uuid(),
                'course_answer_id' => $Answer->id,
                'course_question_id' => $question->id,
                'status' => $request->status,

            ]);
            $data = [
                'question' => $question->question,

                'Answer' => $Answer->answer,
                'status' => $questionAnswer->status
            ];

            return $this->storeResponse($data);
        }
    }
    /*********************************************
     *********************************************
     *******************Show**********************
     *********************************************
     *********************************************/
    public function show($uuid)
    {
        $answer = CourseAnswer::with('course_questions')->where('uuid', $uuid)->first();

        if ($answer) {
            $data = [

                'question' => $answer->questions->question,
                new  CourseAnswerResource($answer)
            ];
            return $this->showResponse($data);
        }
        return $this->notfoundResponse('the Course Not Found');
    }
    // ***********************************************
    // ***********************************************
    // **************Update***************************
    // ***********************************************
    // ***********************************************

    public function update(CourseAnswerRequest $request, $uuid)
    {
        $Answer = CourseAnswer::where('uuid', $uuid)->first();
        if (!$Answer) {
            return $this->notfoundResponse('the Answer Not Found');
        }
        $question = CourseQuestion::where('question', $request->question_name)->first();


        $Answer->update([
            'uuid' => Str::uuid(),
            'answer' => $request->answer,


        ]);

       
    $Answer->questions()->detach(); // Remove the existing associations
    $Answer->questions()->attach($question, ['uuid'=>Str::uuid(),'status' => $request->status]); // Attach the new association


        if ($Answer) {
            return $this->updateResponse(new CourseAnswerResource($Answer));
        }

        return $this->errorResponse('you con not update the Answer ', 404);
    }
    // ************************************************
    // ************************************************
    // **********************Delete********************
    // ************************************************
    // ************************************************
    public function destroy($uuid)
    {
        $answer = CourseAnswer::where('uuid', $uuid)->first();


        if ($answer) {
            $answer->delete();

            return $this->destroyResponse();
        }
        return $this->errorResponse('you con not delete the Answer', 400);
    }
}
