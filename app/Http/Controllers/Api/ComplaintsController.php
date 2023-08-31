<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaints;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $complaints = Complaints::all();
        $data = $complaints->map(function ($complaint) {
            return [
                'id' => $complaint->id,
                'name' => $complaint->user->username,
                'phone' => $complaint->user->phone,
                'subject' => $complaint->complaints,
                'created_at' =>  Carbon::parse($complaint->created_at)->diffForHumans(), 
            ];
        });

        return $this->indexResponse($data);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $complaint = Complaints::create([
            'user_id' => $user->id,
            'complaints' => $request->complaint,
        ]);

        $data = [
            'name' => $user->username,
            'complaints' => $complaint->complaints,
        ];

        return $this->storeResponse($data);
    }

    public function show($id)
    {
        $complaint = Complaints::findOrFail($id);
        $data = [
            'name' => $complaint->user->username,
            'phone' => $complaint->user->phone,
            'subject' => $complaint->complaints,
            'created_at' =>  Carbon::parse($complaint->created_at)->diffForHumans(), 

        ];

        return $this->showResponse($data);

    }

    public function MyComplaint()
    {
        $user = Auth::user();
        $complaints = Complaints::where('user_id',$user->id)->get();
        foreach($complaints as $complaint){
        $data[] = [
            'subject' => $complaint->complaints,
            'created_at' =>  Carbon::parse($complaint->created_at)->diffForHumans(), 

        ];
}
        return $this->showResponse($data);

    }


    public function update(Request $request, $id)
    {
        $complaint = Complaints::findOrFail($id);
        $complaint->update([
            'complaints' => $request->complaint,
        ]);

        $data = [
            'name' => $complaint->user->username,
            'phone' => $complaint->user->phone,
            'subject' => $complaint->complaints,
        ];

        return $this->updateResponse($data);
    }

    public function destroy($id)
    {
        $complaint = Complaints::findOrFail($id);
        $complaint->delete();

        return $this->destroyResponse();
    }


    
    public function showTrash()
    {
        $Complaints = Complaints::onlyTrashed()->get();
        $data=[];
        foreach($Complaints as $Complaint){
            $data[]=[
                'id' => $Complaint->uuid,
                'Complaint' => $Complaint->complaints
            ];
        }
    
            return $this->showResponse($data);
        
    }
    public function restore($uuid)
    {
        $Complaint = Complaints::onlyTrashed()->where('uuid',$uuid)->first();
        if(!$Complaint ){
            return $this->notfoundResponse('Complaint Not Found' );

        }
        $Complaint->restore();
    
        return $this->successResponse('Success Restore');
        
    }

    public function foreceDelete($uuid)
    {
        $Complaint = Complaints::onlyTrashed()->where('uuid',$uuid)->first();
        if(!$Complaint ){
            return $this->notfoundResponse('Complaint Not Found' );
        }
        $Complaint->forceDelete();
    
        return $this->successResponse('Success Restore');
        
    }



}
