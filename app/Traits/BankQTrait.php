<?php

namespace App\Traits;


trait BankQTrait
{
    public function formatQuestionData($questions, $type)
    {
        $formattedQuestions = [];

        foreach ($questions as $question) {
            $questionData = [
                'question_id' => $question->uuid,
                'question' => $question->question,
                'reference' => optional($question->reference)->reference?$question->reference->reference : null,
                'answers' => [],
            ];

            foreach ($question->answers as $answer) {
                $answerData = [
                    'answer_id' => $answer->uuid,
                    'answer' => $answer->answer,
                    'status' => $answer->status??$answer->pivot->status
                ];

                $questionData['answers'][] = $answerData;
            }

            $formattedQuestions[] = $questionData;
        }

        return $formattedQuestions;
    }
}