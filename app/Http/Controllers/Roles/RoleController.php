<?php

namespace App\Http\Controllers\Roles;


use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponseTrait;


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
        return $this->apiResponse('data all role','',$role);
    }
    public function store(RoleRequest $request)
    {
        
        $role = Role::create([
            'role_name' => $request->role_name,
        ]);

        if ($role) {
            return $this->successResponse('the role  Save',new RoleResource($role) );
        }
        return $this->errorResponse('the role Not Save');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = role::find($id);

        if ($role) {
            return $this->successResponse(null,new RoleResource($role));
        }
        return $this->errorResponse('the role Not Found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        // if ($request->fails()) {
        //     return $this->apiResponse(null, $request->errors(), 400);
        // }
        $role = role::find($id);
        if (!$role) {
            return $this->errorResponse('the role Not Found', 404);
        }
       

            $role->update([
                'role_name' => $request->role_name,

            ]);

            if ($role) {
                return $this->successResponse('the role update',new roleResource($role));
            }
       
        return $this->errorResponse('you con not updet the role ', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Role = Role::find($id);

        
            $Role->delete();
            if ($Role) {
                return $this->successResponse( 'the Role deleted',null);
            }
            return $this->errorResponse('you con not delete the Role', 400);
        
        
    }
    
}
