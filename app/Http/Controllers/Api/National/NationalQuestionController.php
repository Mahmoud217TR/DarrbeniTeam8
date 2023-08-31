<?php

namespace App\Http\Controllers\Api\National;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalQuestionRequest;
use App\Http\Resources\NationalQuestionResource;
use App\Models\Course;
use App\Models\NationalQuestion;
use App\Models\Spacialization;
use App\Traits\ApiResponseTrait;
use App\Traits\NationalAQTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NationalQuestionController extends Controller
{
    use ApiResponseTrait;
    use NationalAQTrait;

    public function index()
    {
        $questions = NationalQuestionResource::collection(NationalQuestion::all());
        return $this->indexResponse($questions);
    }
    // *********************************************
    public function store(NationalQuestionRequest $request)
    {
        $specialization = Spacialization::where('name', $request->specialization_name)->first();
        if (!$specialization) {
            return $this->notfoundResponse('Specialization Not Found');
        }
        $course = Course::where('name', $request->course_name)->first();
        if (!$course) {
            return $this->notfoundResponse('Specialization Not Found');
        }

        $nationalQuestion = NationalQuestion::create([
            'uuid' => Str::uuid(),
            'question' => $request->question,
            'date' => $request->date,
            'spacialization_id' => $specialization->id,
            'course_id' => $course->id,
        ]);

        $nationalQuestion->reference()->create([
            'uuid' => Str::uuid(),
            'reference' => $request->reference,
        ]);

        if ($nationalQuestion) {
            return $this->storeResponse(new NationalQuestionResource($nationalQuestion));
        }

        return $this->errorResponse('Failed to save the question');
    }
    public function show($uuid)
    {
        $nationalQuestion = NationalQuestion::where('uuid', $uuid)->first();

        if (!$nationalQuestion) {
            return $this->notfoundResponse('National Question Not Found');
        }

        return $this->showResponse(new NationalQuestionResource($nationalQuestion));
    }
    // ***********************************************
    public function update(Request $request, $uuid)
    {
        $nationalQuestion = NationalQuestion::where('uuid', $uuid)->first();
        if (!$nationalQuestion) {
            return $this->errorResponse('Question Not Found', 404);
        }

        $specialization = Spacialization::where('name', $request->specialization_name)->first();
        if (!$specialization) {
            $specialization = $nationalQuestion->spacialization->id;
        }
        $course = Course::where('name', $request->course_name)->first();
        if (!$course) {
           $course = $nationalQuestion->course->id;
        }

        $nationalQuestion->update([
            'question' => $request->question??$nationalQuestion->question,
            'date' => $request->date?? $nationalQuestion->date,
            'spacialization_id' => $specialization->id?? $nationalQuestion->spacialization->id,
            'course_id' => $course->id ?? $nationalQuestion->course->id
         ]);

        $nationalQuestion->reference()->update([
            'reference' => $request->reference??$nationalQuestion->reference->reference,
        ]);

        if ($nationalQuestion) {
            return $this->updateResponse(new NationalQuestionResource($nationalQuestion));
        }

        return $this->errorResponse('Failed to update the question', 404);
    }
    public function destroy($uuid)
    {
        $nationalQuestion = NationalQuestion::where('uuid', $uuid)->first();

        if ($nationalQuestion) {
            $nationalQuestion->reference()->delete();
            $nationalQuestion->delete();
            return $this->destroyResponse();
        }

        return $this->errorResponse('Failed to delete the question', 400);
    }
    // ***************************************************************
    // ***********************index question and answers****************
    // ******************************************************************
  

    public function indexAll()
    {
        $questions = NationalQuestion::with('answers')->get();
        $result = $this->formatQuestionData($questions);
        return $this->indexResponse($result);
    }
    // *****************************************************
    // *****************************************************
    // ***************show National Question****************
    public function showAll($uuid)
    {
        $specialization = Spacialization::where('uuid', $uuid)->first();
        $questions = NationalQuestion::where('spacialization_id', $specialization->id)->get();
        $result = $this->formatQuestionData($questions);
        return $this->indexResponse($result);
    }
    // *********show National Question with course*********
    // *****************************************************
    public function showAllCourse($uuid)
    {
        $course = Course::where('uuid', $uuid)->first();

        if (!$course) {
            return $this->notfoundResponse('Course Not Found');
        }

        $questions = NationalQuestion::where('course_id', $course->id)->get();
        $randomQuestions = $questions->shuffle()->take(min(50, $questions->count()));
        $result = $this->formatQuestionData($randomQuestions);

        return $this->indexResponse($result);
    }


    ////////////////////date/////////////////////////////
    public function date($uuid)
    {
        $specialization = Spacialization::where('uuid', $uuid)->first();

        if (!$specialization) {
            return $this->notfoundResponse('Specialization Not Found');
        }

        $uniqueDates = NationalQuestion::where('spacialization_id', $specialization->id)
            ->distinct('date')
            ->pluck('date');

        return $this->showResponse(['dates' => $uniqueDates]);
    }

    public function showAllDate($uuid, Request $request)
    {
        $specialization = Spacialization::where('uuid', $uuid)->first();

        if (!$specialization) {
            return $this->notfoundResponse('Specialization Not Found');
        }

        $questions = NationalQuestion::where([
            'spacialization_id' => $specialization->id,
            'date' => $request->date,
        ])->get();

        $result = $this->formatQuestionData($questions);

        return $this->indexResponse($result);
    }


        public function showTrash()
    {
        $NationalQuestions = NationalQuestion::onlyTrashed()->get();
        $data=[];
        foreach($NationalQuestions as $question){
            $data[]=[
                'id' => $question->uuid,
                'question' => $question->question
            ];
        }
    
            return $this->showResponse($data);
        
    }
    public function restore($uuid)
    {
        $question = NationalQuestion::onlyTrashed()->where('uuid',$uuid)->first();
        if(!$question ){
            return $this->notfoundResponse('Question Not Found' );

        }
        $question->restore();
    
        return $this->successResponse('Success Restore');
        
    }

    public function foreceDelete($uuid)
{
    $NationalQuestion = NationalQuestion::onlyTrashed()->where('uuid',$uuid)->first();
    if(!$NationalQuestion ){
        return $this->notfoundResponse('NationalQuestion Not Found' );
    }
    $NationalQuestion->forceDelete();

    return $this->successResponse('Success Restore');
    
}

        
}
