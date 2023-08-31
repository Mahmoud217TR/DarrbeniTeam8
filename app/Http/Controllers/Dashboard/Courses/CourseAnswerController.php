<?php

namespace App\Http\Controllers\Dashboard\Courses;

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
        $courseAnswer = CourseAnswer::get();



        return  view('dashboard.pages.courseAnswers.index',compact('courseAnswer'));
    }



    public function create(){
        $question = CourseQuestion::all();
        return  view('dashboard.pages.courseAnswers.form',compact('question'));
    }
    // *****************************************************
    // *****************************************************
    // *************************Store************************
    // ******************************************************
    // ******************************************************
    public function store(CourseAnswerRequest $request)
    {
        $question = CourseQuestion::where('id', $request->question_id)->first();
        
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
            return redirect()->route('courseAnswers.index')->with('Answer  created successfully');

        
       
    }
    /*********************************************
     *********************************************
     *******************Show**********************
     *********************************************
     *********************************************/
    public function show($uuid)
    {
        $courseAnswer = CourseAnswer::where('uuid',$uuid)->first();



        return  view('dashboard.pages.courseAnswers.show',compact('courseAnswer'));
    }
    public function edit($uuid){
        $Answer = CourseAnswer::where('uuid', $uuid)->first();
        $question = CourseQuestion::all();

        return  view('dashboard.pages.courseAnswers.edit',compact('Answer','question'));

    }
    // ***********************************************
    // ***********************************************
    // **************Update***************************
    // ***********************************************
    // ***********************************************

    public function update(CourseAnswerRequest $request, $uuid)
    {
        $Answer = CourseAnswer::where('uuid', $uuid)->first();
    
        $question = CourseQuestion::where('question', $request->question_id)->first();


        $Answer->update([
            'uuid' => Str::uuid(),
            'answer' => $request->answer,


        ]);

       
    $Answer->questions()->detach(); // Remove the existing associations
    $Answer->questions()->attach($question, ['uuid'=>Str::uuid(),'status' => $request->status]); // Attach the new association


        if ($Answer) {
            return redirect()->route('courseAnswer.index')->with("Course Answer  update successfully");
        }

        return  redirect()->route('courseAnswer.index')->with(" Course Answer Not Found");
    }
    // ************************************************
    // ************************************************
    // **********************Delete********************
    // ************************************************
    // ************************************************
    public function destroy($uuid)
    {
        $answer = CourseAnswer::where('uuid', $uuid)->first();


   
            $answer->delete();

            return redirect()->back();
        }
    
    
    
        public function showsoft()
        {
            $courseAnswer = CourseAnswer::onlyTrashed()->get();
            return view('dashboard.pages.courseAnswers.recycleBin', compact('courseAnswer'));
        }
        public function restor($uuid)
        {
            CourseAnswer::withTrashed()->where('uuid', $uuid)->restore();
            return redirect()->back();
        }
    
    
        public function finaldelete($uuid)
        {
            $CourseAnswer = CourseAnswer::withTrashed()->where('uuid', $uuid)->first();
    
       
            $CourseAnswer->forceDelete();
    
            return redirect()->back();
        }
    }
    