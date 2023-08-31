<?php

namespace App\Http\Controllers\Dashboard\National;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalQuestionRequest;
use App\Http\Resources\NationalQuestionResource;
use App\Models\Course;
use App\Models\NationalQuestion;
use App\Models\Spacialization;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NationalQuestionController extends Controller
{


    public function index()
    {

        $question = NationalQuestion::with('answers')->get();

        return view('dashboard.pages.nationalQuestion.index', compact('question'));
    }
    public function create(){
        $specialization = Spacialization::all();  
        $course = Course::all();

        return  view('dashboard.pages.nationalQuestion.form',compact('specialization','course'));
      
    }

    
      // *********************************************
    // *********************************************
    // *****************Store***********************
    // *********************************************
    // *********************************************

    public function store(NationalQuestionRequest $request)
    {
        
       

            $nationalquestion = NationalQuestion::create([
                'uuid' => Str::uuid(),
                'question' => $request->question,
                'date' => $request->date,
                'course_id'=>$request->course_id,
                'spacialization_id' => $request->specialization_id,
            ]);
            $nationalquestion->reference()->create([
                'uuid' => Str::uuid(),

                'reference' => $request->reference,
            ]);


            if ($nationalquestion) {

                return redirect()->route('nationalQuestion.index')->with('National Question  created successfully');
            }
            return redirect()->route('nationalQuestion.index')->with('the National question Not Save');
      
    }
    /*********************************************
     *********************************************
     *******************Show**********************
     *********************************************
     *********************************************/
    public function show($uuid)
    {
        $question = NationalQuestion::with('answers')->where('uuid',$uuid)->first();

        return view('dashboard.pages.nationalQuestion.show', compact('question'));
        
    }

    public function edit($uuid){
        $specialization = Spacialization::all();  
        $course = Course::all();
        $nationalquestion=NationalQuestion::where('uuid',$uuid)->first();

        return  view('dashboard.pages.nationalQuestion.edit',compact('specialization','course','nationalquestion'));
      
    }
      // ***********************************************
    // ***********************************************
    // **************Update***************************
    // ***********************************************
    // ***********************************************
    public function update(NationalQuestionRequest $request, $uuid)
    {

        $nationalquestion = NationalQuestion::where('uuid', $uuid)->first();
        
        


            $nationalquestion->update([
                'question' => $request->question,
                'date' => $request->date,
                'spacialization_id' => $request->specialization_id,
                'course_id'=>$request->course_id,

            ]);
            $nationalquestion->reference()->update([
                'reference' => $request->reference,
            ]);

            if ($nationalquestion) {
                return redirect()->route('nationalQuestion.index')->with('National Question  update successfully');
            }
            return redirect()->route('nationalQuestion.index')->with('the National question Not Save');
        }
    

    public function destroy($uuid)
    {
        $NationalQuestion = NationalQuestion::where('uuid', $uuid)->first();



        $NationalQuestion->delete();

        return redirect()->back();
    }



    public function showsoft()
    {
        $question = NationalQuestion::onlyTrashed()->get();
        return view('dashboard.pages.nationalQuestion.recycleBin', compact('question'));
    }
    public function restor($uuid)
    {
        NationalQuestion::withTrashed()->where('uuid', $uuid)->restore();
        return redirect()->back();
    }


    public function finaldelete($uuid)
    {
        $NationalQuestion = NationalQuestion::withTrashed()->where('uuid', $uuid)->first();

   
        $NationalQuestion->forceDelete();

        return redirect()->back();
    }
}
