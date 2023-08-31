<?php

namespace App\Http\Controllers\Dashboard\National;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalAnswerRequest;
use App\Http\Resources\NationalAnswerResource;
use App\Models\NationalAnswer;
use App\Models\NationalQuestion;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NationalAnswerController extends Controller
{


    public function index()
    {
        $answers = NationalAnswer::all();

        return view('dashboard.pages.nationalAnswers.index', compact('answers'));
    }



    public function create()
    {
        $question = NationalQuestion::all();
      
        return view('dashboard.pages.nationalAnswers.form', compact( 'question'));
    }



    public function store(NationalAnswerRequest $request)
    {

        $NationalAnswer = NationalAnswer::create([
            'uuid' => Str::uuid(),
            'answer' => $request->answer,
            'national_question_id' => $request->question_id,
            'status' => $request->status,

        ]);

        if ($NationalAnswer) {
            return redirect()->route('nationalAnswer.index')->with('national Answer Can Not Create');
        }
        return redirect()->route('nationalAnswer.index')->with('national Answer Created');;
    }


    /*********************************************
     *********************************************
     *******************Show**********************
     *********************************************
     *********************************************/
    public function show($uuid)
    {
        $answer = NationalAnswer::where('uuid', $uuid)->first();

        return view('dashboard.pages.nationalAnswers.show', compact('answer'));
    }
    // ***********************************************
    // ***********************************************
    // **************Update***************************
    // ***********************************************
    // ***********************************************
    public function edit($uuid)
    {
        $question = NationalQuestion::all();
        $answer = NationalAnswer::where('uuid', $uuid)->first();
        return view('dashboard.pages.nationalAnswers.edit', compact('answer', 'question'));
    }


    public function update(NationalAnswerRequest $request, $uuid)
    {

        $NationalAnswer =  NationalAnswer::where('uuid', $uuid)->first();





        $NationalAnswer->update([
            'uuid' => Str::uuid(),
            'answer' => $request->answer,
            'national_question_id' => $request->question_id,
            'status' => $request->status,

        ]);

        if ($NationalAnswer) {
            return redirect()->route('nationalanswer.index')->with('national answer  Update successfully');
        }

        return redirect()->route('nationalanswer.index')->with(' you can not  Update national answer ');
    }



    public function destroy($uuid)
    {
        $NationalAnswer = NationalAnswer::where('uuid', $uuid)->first();


      
            $NationalAnswer->delete();
            return redirect()->back();
    }



    public function showsoft()
    {
        $answers = NationalAnswer::onlyTrashed()->get();
        return view('dashboard.pages.nationalAnswers.recycleBin', compact('answers'));
    }
    public function restor($uuid)
    {
        NationalAnswer::withTrashed()->where('uuid', $uuid)->restore();
        return redirect()->back();
    }


    public function finaldelete($uuid)
    {
        $NationalAnswer = NationalAnswer::withTrashed()->where('uuid', $uuid)->first();

   
        $NationalAnswer->forceDelete();

        return redirect()->back();
    }
}
