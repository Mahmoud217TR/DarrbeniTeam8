<?php

namespace App\Http\Controllers\Api\National;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalAnswerRequest;
use App\Http\Resources\NationalAnswerResource;
use App\Models\NationalAnswer;
use App\Models\NationalQuestion;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NationalAnswerController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $questions = NationalQuestion::all();
        $array = [];

        foreach ($questions as $question) {
            $Answers = [];
            foreach ($question->answers as $Answer) {
                $Answers[] = $Answer->answer;
            }
            $array[] = [
                "question" => $question->question,
                "date"=>$question->date,
                "answers" => $Answers
            ];
        }
        return $this->indexResponse($array);
    }


    public function store(NationalAnswerRequest $request)
    {
        $question = NationalQuestion::where('question', $request->question_name)->first();
        if (!$question) {
            return $this->notfoundResponse('question Not Found');
        } else {
            $NationalAnswer = NationalAnswer::create([
                'uuid' => Str::uuid(),
                'answer' => $request->answer,
                'national_question_id' => $question->id,
                'status' => $request->status,

            ]);

            if ($NationalAnswer) {
                return $this->storeResponse(new NationalAnswerResource($NationalAnswer) );
              
            }
            return $this->errorResponse('the National Answer Not Save');
        }
    }

 /********************Show**********************/
    public function show($uuid)
    {
        $answer = NationalAnswer::where('uuid', $uuid)->first();

        if ($answer) {
            $data = [
              'answer'=>new NationalAnswerResource( $answer)
            ];
           
            return $this->showResponse($data);
        }
        return $this->notfoundResponse('the question Not Found');
    }
   
    // **************Update***************************


    public function update(NationalAnswerRequest $request, $uuid)
    {

        $NationalAnswer =  NationalAnswer::where('uuid', $uuid)->first();
        if (!$NationalAnswer) {
            return $this->errorResponse('the  National Answer Not Found', 404);
        }
        $question = NationalQuestion::where('question', $request->question_name)->first();
        if (!$question) {
            return $this->notfoundResponse('question Not Found');
        } else {
      


        $NationalAnswer->update([
            'uuid' => Str::uuid(),
                'answer' => $request->answer,
                'national_question_id' => $question->id,
                'status' => $request->status,

        ]);

        if ($NationalAnswer) {
            return $this->updateResponse(new  NationalAnswerResource($NationalAnswer));
        }

        return $this->errorResponse('you con not update the  NationalAnswer ', 404);
    }
    }


    public function destroy($uuid)
    {
        $NationalAnswer = NationalAnswer::where('uuid', $uuid)->first();


        if ($NationalAnswer) {
        $NationalAnswer->delete();

            return $this->destroyResponse();
        }
        return $this->errorResponse('you con not delete the national answer', 400);
    }
}
