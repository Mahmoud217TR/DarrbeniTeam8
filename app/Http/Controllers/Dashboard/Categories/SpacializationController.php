<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpacializationRequest;
use App\Models\Collage;
use App\Models\Spacialization;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

use illuminate\Support\Str;


class SpacializationController extends Controller
{
    //
    public function index()
    {

        $specializations = Spacialization::with('collage')->get();



        return  view('dashboard.pages.specializations.index', compact('specializations'));
    }
    public function create()
    {
        $collage = Collage::all();
        return view('dashboard.pages.specializations.form', compact('collage'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(spacializationRequest $request)
    {
        //
        $collage = Collage::where('id', $request->collage_id)->first();


       


            $specialization = Spacialization::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'collage_id' => $collage->id
            ]);




            return redirect()->route('specialization.index')->with('specialization  created successfully');
       
    }



    public function show($uuid)
    {
        // Find the college with the provided ID
        $specialization = Spacialization::with('collage')->where('uuid', $uuid)->first();


        return view('dashboard.pages.specializations.show', compact('specialization'));
    }


    public function edit($uuid)
    {
       

        $collage = Collage::all();
        $specialization=Spacialization::where('uuid',$uuid)->first();

        return view('dashboard.pages.specializations.edit', compact('collage','specialization'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(spacializationRequest $request, $uuid)
    {

        $collage = Collage::where('id', $request->category_id)->first();
        $specialization=Spacialization::where('uuid', $uuid)->first();

        


            $specialization->update([
            
                'name' => $request->input('name', $specialization->name) ?: $specialization->name,
                'collage_id' => $collage->id ?: $specialization->collage_id



            ]);




            return redirect()->route('specialization.index')->with('Specialization  updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $specialization = Spacialization::where('uuid', $uuid)->first();
      
            $specialization->delete();
            return redirect()->back();
        }
    
    
    
        public function showsoft()
        {
            $specializations = Spacialization::onlyTrashed()->get();
            return view('dashboard.pages.specializations.recycleBin', compact('specializations'));
        }
        public function restor($uuid)
        {
            Spacialization::withTrashed()->where('uuid', $uuid)->restore();
            return redirect()->back();
        }
    
    
        public function finaldelete($uuid)
        {
            $specialization = Spacialization::withTrashed()->where('uuid', $uuid)->first();
    
       
            $specialization->forceDelete();
    
            return redirect()->back();
        }
    }
    