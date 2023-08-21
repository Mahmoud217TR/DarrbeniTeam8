<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalQuestionRequest;
use App\Http\Resources\NationalQuestionResource;
use App\Models\NationalQuestion;
use App\Models\Spacialization;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NationalQuestionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        $question = NationalQuestionResource::collection(NationalQuestion::all());

        return $this->indexResponse($question);
    }
      // *********************************************
    // *********************************************
    // *****************Store***********************
    // *********************************************
    // *********************************************

    public function store(NationalQuestionRequest $request)
    {
        $specialization = Spacialization::where('name', $request->specialization_name)->first();
        if (!$specialization) {
            return $this->notfoundResponse('specialization Not Found');
        } else {

            $nationalquestion = NationalQuestion::create([
                'uuid' => Str::uuid(),
                'question' => $request->question,
                'date' => $request->date,
                'spacialization_id' => $specialization->id,
            ]);
            $nationalquestion->reference()->create([
                'uuid' => Str::uuid(),

                'reference' => $request->reference,
            ]);


            if ($nationalquestion) {

                return $this->storeResponse(new NationalQuestionResource($nationalquestion));
            }
            return $this->errorResponse('the nationalquestion Not Save');
        }
    }
    /*********************************************
     *********************************************
     *******************Show**********************
     *********************************************
     *********************************************/
    public function show($uuid)
    {
        $nationalquestion = NationalQuestion::where('uuid', $uuid)->first();

        if ($nationalquestion) {
       
            return $this->showResponse( new  NationalQuestionResource($nationalquestion));
        }
        return $this->notfoundResponse('the National question Not Found');
    }
      // ***********************************************
    // ***********************************************
    // **************Update***************************
    // ***********************************************
    // ***********************************************
    public function update(NationalQuestionRequest $request, $uuid)
    {

        $nationalquestion = NationalQuestion::where('uuid', $uuid)->first();
        if (!$nationalquestion) {
            return $this->errorResponse('the question Not Found', 404);
        }
        $specialization = Spacialization::where('name', $request->specialization_name)->first();
        if (!$specialization) {
            return $this->notfoundResponse('specialization Not Found');
        } else {


            $nationalquestion->update([
                'question' => $request->question,
                'date' => $request->date,
                'spacialization_id' => $specialization->id,

            ]);
            $nationalquestion->reference()->update([
                'reference' => $request->reference,
            ]);

            if ($nationalquestion) {
                return $this->updateResponse( new NationalQuestionResource($nationalquestion));
            }

            return $this->errorResponse('you con not update the question ', 404);
        }
    }

    public function destroy($uuid)
    {
        $NationalQuestion = NationalQuestion::where('uuid', $uuid)->first();



        if ($NationalQuestion) {
        $NationalQuestion->delete();

            return $this->destroyResponse();
        }
        return $this->errorResponse('you con not delete the question', 400);
    }
}
