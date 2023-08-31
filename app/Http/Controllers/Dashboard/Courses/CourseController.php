<?php

namespace App\Http\Controllers\Dashboard\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Spacialization;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    use ApiResponseTrait;

    public function index()
    { 
        $courses = Course::with('spacialization')->get();



        return  view('dashboard.pages.course.index',compact('courses'));

       
       
    }
    public function create()  {
        $specialization = Spacialization::all();  
        return  view('dashboard.pages.course.form',compact('specialization'));

    }
    // *********************************************
    // *********************************************
    // *****************Store***********************
    // *********************************************
    // *********************************************

    public function store(CourseRequest $request)
    {
        $Spacialization = Spacialization::where('id', $request->Spacialization_id)->first();

       
        


            $course = Course::create([
                'uuid' => Str::uuid(),

                'name' => $request->name,

                'spacialization_id' => $Spacialization->id,
            ]);
            return redirect()->route('course.index')->with('Course  created successfully');
           
    }
// ***********************************************
// ***********************************************
// *********************Show**********************
// **********************************************
// **********************************************

    public function show($uuid)
    {
        $course = Course::where('uuid', $uuid)->first();
        return  view('dashboard.pages.course.show',compact('course'));

       
    }

    public function edit($uuid)  {
        $specialization = Spacialization::all();  
        $course=Course::where('uuid',$uuid)->first();
        return  view('dashboard.pages.course.edit',compact('specialization','course'));

    }

    // ******************************************************
    // ******************************************************
    // ***************Update********************************
    // ****************************************************
    // **************************************************
    public function update(CourseRequest $request, $uuid)
    {
        $specialization = Spacialization::where('name', $request->Spacialization_id)->first();
        
            $course = Course::where('uuid', $uuid)->first();
           


            $course->update([
                'name' => $request->name,
                'spacialization_id' => $specialization->id,
            ]);

            if ($course) {
                return redirect()->route('course.index')->with("Course   update successfully");
            }

            return  redirect()->route('course.index')->with(" Course  Not Found");
        
    }

    // ********************************************8
    // ********************************************
    // *************Delete************************
    // *******************************************
    public function destroy($uuid)
    {
        $Course = Course::where('uuid', $uuid)->first();


        $Course->delete();
        return redirect()->back();
    }



    public function showsoft()
    {
        $courses = Course::onlyTrashed()->get();
        return view('dashboard.pages.course.recycleBin', compact('courses'));
    }
    public function restor($uuid)
    {
        Course::withTrashed()->where('uuid', $uuid)->restore();
        return redirect()->back();
    }


    public function finaldelete($uuid)
    {
        $Course = Course::withTrashed()->where('uuid', $uuid)->first();

   
        $Course->forceDelete();

        return redirect()->back();
    }
}
