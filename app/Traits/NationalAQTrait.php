<?php

namespace App\Traits;


trait NationalAQTrait
{
public function formatQuestionData($questions)
{
    $result = [];

    foreach ($questions as $question) {
        $questionData = [
            'uuid' => $question->uuid,
            'question' => $question->question,
            'reference' => optional($question->reference)->reference,
            'answers' => $this->formatAnswerData($question->answers),
        ];

        $result[] = $questionData;
    }

    return $result;
}

public function formatAnswerData($answers)
{
    return $answers->map(function ($answer) {
        return [
            'uuid' => $answer->uuid,
            'answer' => $answer->answer,
            'status' => $answer->status,
        ];
    })->toArray();
}

}