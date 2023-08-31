<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseQuestion;
use App\Models\NationalQuestion;
use App\Models\Spacialization;
use App\Traits\ApiResponseTrait;
use App\Traits\BankQTrait;
use Illuminate\Http\Request;

class BankQuestionController extends Controller
{
    use ApiResponseTrait;
    use BankQTrait;
   
    public function show($uuid)
    {
        $responseData = [];

        $spacialization = Spacialization::where('uuid', $uuid)->first();

        if (!$spacialization) {
            return $this->notfoundResponse('Spacialization Not Found');
        }

        $courses = Course::where('spacialization_id', $spacialization->id)->get();

        if ($courses->isEmpty()) {
            return $this->notfoundResponse('Courses Not Found');
        }

        foreach ($courses as $course) {
            $courseQuestions = CourseQuestion::where('course_id', $course->id)->get();
            $nationalQuestions = NationalQuestion::where('course_id', $course->id)->get();

            $randomCourseQuestions = $courseQuestions->shuffle()->take(min(50, $courseQuestions->count()));
            $randomNationalQuestions = $nationalQuestions->shuffle()->take(min(50, $nationalQuestions->count()));

            $responseData = array_merge(
                $responseData,
                $this->formatQuestionData($randomCourseQuestions, 'course'),
                $this->formatQuestionData($randomNationalQuestions, 'national')
            );
        }

        return $this->showResponse($responseData);
    }

  

}
