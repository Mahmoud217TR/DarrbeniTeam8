<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseAnswer;
use App\Models\CourseAnswerQuestion;
use App\Models\CourseQuestion;
use App\Models\NationalAnswer;
use App\Models\NationalQuestion;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    use ApiResponseTrait;
   
    public function show(Request $request)
    {
        $count =count($request->data);
        $correctAnswers = 0;
        $wrongAnswers =[];
        foreach($request->data as $data){
            $question = $this->getQuestionByUuid($data['question'],$data['question']);

            if(!$question){
                return $this->notfoundResponse("Not Found Question");
            }
            
            $answer = CourseAnswer::where('uuid',$data['answer'])->first()
              ?? NationalAnswer::where('uuid',$data['answer'])->first();
            
            if(!$answer){
                return $this->notfoundResponse("Not Found answer");
            }
            $question_uuid = $question->uuid;
            $answer_uuid = $answer->uuid;
            $answer_id =$answer->id;
            
            
            $check = NationalAnswer::where('uuid',$answer_uuid)->first()
                ??  CourseAnswerQuestion::where('course_answer_id',$answer_id)->first();

            if($check->status == 1){
                $correctAnswers++ ;
            }else{
                $get_correct = $this->getQuestionByUuid($question_uuid,$question_uuid);

                foreach($get_correct->answers as $corr_ans){
                    $status = $corr_ans->status ?? $corr_ans->pivot->status ?? 0;
                    if ($status === 1) {
                        $wrongAnswers[] = [
                            
                            'question' => $question->uuid,
                            'correct_answer' => $corr_ans->uuid,
                            'reference' => optional($question->reference)->reference,
                        ];
                    }
                }
               
            }            
        }
        $all[]=[
            'count' => $count,
            'score' => $correctAnswers,
            'avg'=> (($correctAnswers*100)/$count).'%',
            'wronge_Answers' => $wrongAnswers
        ];
        return $this->showResponse($all);
    }

    private function getQuestionByUuid($cid,$nid)
    {
        return CourseQuestion::where('uuid', $cid)->first()
            ?? NationalQuestion::where('uuid', $nid)->first();
    }

    // { "data":
    //     [
            
    //         {
    //              "question":"8f64fbf0-736e-499e-9a2a-64995a6ead83",
    //             "answer":"948bc470-a323-439a-a8b7-4789242025e9"
    //         },
    //       
    //     ]
    //     }
}
