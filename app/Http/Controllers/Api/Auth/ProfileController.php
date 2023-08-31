<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\user;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $users = User::all();
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'uuid' => $user->uuid,
                'username' => $user->username,
                'phone' => $user->phone,
            ];
        }

        return $this->indexResponse($data);
    }


    public function show()
    {
        // Authenticated user
        $user = auth()->user();
        $date = [
            'username' => $user->username,
            'phone' => $user->phone,
        ];
        return $this->showResponse($date);
    }

    public function showAdmin($uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        if (!$user) {
            return $this->notFoundResponse('You do not have permission');
        }

        $data = [
            'username' => $user->username,
            'phone' => $user->phone,
            'college' => $user->codes->collage->name, 
        ];

        return $this->showResponse($data);
    }

  
    public function update(Request $request, user $user)
    {
        $user = auth()->user();
        if(!$user){
            return $this->notfoundResponse('U do not have permetion');
        }
            // Update user attributes based on request data or keep the existing value
            $user->update([
                'username' => $request->input('username', $user->username)?:$user->username,
                'phone' => $request->input('phone', $user->phone)?:$user->phone,
            ]);

          

            $data = [
                'username' => $user->username,
                'phone' => $user->phone,
            ];

            return $this->updateResponse($data);
        

    }


    public function destroy($uuid)
    {
        $user = User::where('uuid',$uuid)->first();
        $user->delete();

        return $this->destroyResponse();
    }
}
