<?php

namespace App\Http\Controllers\Categories;

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
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        
            $spacializations = Spacialization::with('collage')->get();
            if($spacializations){
            $data = [];
            foreach ($spacializations as $spacialization) {
                $data[] = [
                    'id' =>$spacialization->uuid,
                    'name' => $spacialization->name,
                    'collage_name' => $spacialization->collage->name,
                ];
            }
    
            return $this->indexResponse($data);
        } else {
            // Handle the exception and provide an error response
            return $this->errorResponse("Failed to retrieve spacialization");
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpacializationRequest $request)
    {
        //
        $collage = Collage::where('name', $request->collage_name)->first();
        if (!$collage) {
            return $this->notfoundResponse('collage Not Found');
        }else{
            $Spacialization = Spacialization::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'collage_id' => $collage->id
            ]);


            $data = [
                'id' => $Spacialization->uuid,
                'name' => $Spacialization->name,
                'collage_name' => $Spacialization->collage->name,
            ];

            return $this->storeResponse($data);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $specialization = Spacialization::where('uuid',$uuid)->first();
        if(!$specialization){
            return $this->notfoundResponse('This Specializatino Not Found');
        }
        $data =[
            'id' => $specialization->uuid,
            'name' => $specialization->name,
            'collage_name' => $specialization->collage->name
        ];
        return $this->showResponse($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpacializationRequest $request, $uuid)
    {
        $collage = Collage::where('name', $request->input('collage_name'))->first();
    
        if (!$collage) {
            return $this->notfoundResponse('The Collage Not Found');
        }
    
        $spacialization = Spacialization::where('uuid', $uuid)->first();
    
        if ($spacialization) {
            $spacialization->update([
                'name' => $request->name,
                'collage_id' => $collage->id           
            ]);
    
            $data = [
                'name' => $spacialization->name,
                'collage_name' => $collage->name
            ];
    
            return $this->showResponse($data);
        }
    
        // Handle the case when the Spacialization record with the given UUID is not found
        return $this->notfoundResponse('Spacialization Not Found');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $Spacialization = Spacialization::where('uuid',$uuid)->first();
        if($Spacialization){
            $Spacialization->delete();
    
            return $this->destroyResponse("Spacialization deleted successfully");
        } else {
            // Handle the exception and provide an error response
            return $this->notfoundResponse(" Spacialization Not Found");
        }
    }
}
