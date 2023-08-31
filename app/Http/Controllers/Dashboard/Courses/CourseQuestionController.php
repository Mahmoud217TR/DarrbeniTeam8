<?php

namespace App\Http\Controllers\Dashboard\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseQuestionRequest;
use App\Http\Resources\CourseQuestionResource;
use App\Models\Course;
use App\Models\CourseQuestion;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseQuestionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        $courseQuestions = CourseQuestion::with('answers')->get();



        return  view('dashboard.pages.courseQuestion.index',compact('courseQuestions'));
      
    }
    public function create(){
        $course=Course::all();
        return  view('dashboard.pages.courseQuestion.form',compact('course'));
      
    }
    // **********************************************************
    // **********************************************************
    // ***********************Store******************************
    // **********************************************************
    // **********************************************************
    public function store(CourseQuestionRequest $request)
    {
        
        
        $courseQuestion = CourseQuestion::create([
            'uuid' => Str::uuid(),
            'question' => $request->question,
            'course_id' =>  $request->course_id,
        ]);
    
        // Create a reference and associate it with the course question
        $courseQuestion->reference()->create([
            'uuid' => Str::uuid(),

            'reference' =>$request->reference,
        ]);
    
       
    
        return redirect()->route('courseQuestion.index')->with('Course Question created successfully');
           
   
}
    // ***********************************************
    // ***********************************************
    // ******************Show*************************
    // ***********************************************
    // ***********************************************
    public function show($uuid)
    {
     $courseQuestion = CourseQuestion::with('answers')->where('uuid',$uuid)->first();



        return  view('dashboard.pages.courseQuestion.show',compact('courseQuestion'));
    }

    public function edit($uuid){
        $course=Course::all();
        $courseQuestion = CourseQuestion::where('uuid',$uuid)->first();

        return  view('dashboard.pages.courseQuestion.edit',compact('course','courseQuestion'));
    }
    // ********************************************************
    // ********************************************************
    // *******************Update*******************************
    // ********************************************************
    // ********************************************************
    public function update(CourseQuestionRequest $request, $uuid)
    {
        $question = CourseQuestion::where('uuid',$uuid)->first();
        $course = Course::where('name', $request->course_id)->first();


        $question->update([
            'uuid' => Str::uuid(),
            'name' => $request->course_name,
            'course_id' => $course->id,

        ]);
        $question->reference()->update([
            'reference' =>$request->reference,    
        ]);

        if ($question) {
            return $this->updateResponse( new CourseQuestionResource($question));
        }

        return $this->errorResponse('you con not update the question ', 404);
    }
    // ***************************************************
    // ***************************************************
    // *******************Delete**************************
    // ***************************************************
    // ***************************************************
    public function destroy($uuid)
    {
        $question = CourseQuestion::where('uuid',$uuid)->first();


        $question->delete();

        return redirect()->back();
    }



    public function showsoft()
    {
        $courseQuestions = CourseQuestion::onlyTrashed()->get();
        return view('dashboard.pages.courseQuestion.recycleBin', compact('courseQuestions'));
    }
    public function restor($uuid)
    {
        CourseQuestion::withTrashed()->where('uuid', $uuid)->restore();
        return redirect()->back();
    }


    public function finaldelete($uuid)
    {
        $CourseQuestion = CourseQuestion::withTrashed()->where('uuid', $uuid)->first();

   
        $CourseQuestion->forceDelete();

        return redirect()->back();
    }
}
