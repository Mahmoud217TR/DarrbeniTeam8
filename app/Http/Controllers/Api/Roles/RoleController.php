<?php

namespace App\Http\Controllers\Api\Roles;


use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Str;


class RoleController extends Controller
{
    use ApiResponseTrait;
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = RoleResource::collection(Role::all());
        return $this->indexResponse($role);
    }
    public function store(RoleRequest $request)
    {
        
        $role = Role::create([
            'uuid' => Str::uuid(),
            'role_name' => $request->role_name,
        ]);

        if ($role) {
            return $this->storeResponse(new RoleResource($role) );
        }
        return $this->errorResponse('the role Not Save');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $role = role::where('uuid',$uuid)->first();

        if ($role) {
            return $this->showResponse(new RoleResource($role));
        }
        return $this->notfoundResponse('the role Not Found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $uuid)
    {
        // if ($request->fails()) {
        //     return $this->apiResponse(null, $request->errors(), 400);
        // }
        $role = role::where('uuid',$uuid)->first();
        if (!$role) {
            return $this->notfoundResponse('the role Not Found');
        }
       

            $role->update([
            'uuid' => Str::uuid(),
                'role_name' => $request->role_name,

            ]);

            if ($role) {
                return $this->updateResponse(new roleResource($role));
            }
       
        return $this->errorResponse('you con not updet the role ', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $role = role::where('uuid',$uuid)->first();

        
            $role->delete();
            if ($role) {
                return $this->destroyResponse();
            }
            return $this->errorResponse('you con not delete the Role', 400);
        
        
    }
    
}
