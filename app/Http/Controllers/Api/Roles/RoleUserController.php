<?php

namespace App\Http\Controllers\Api\Roles;


use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponseTrait;


class RoleUserController extends Controller
{
    use ApiResponseTrait;
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with('roles')->get();

        $array = [];

        foreach ($users as $user) {
            $roles = [];
            foreach ($user->roles as $role) {
                $roles[] = $role->role_name;
            }
            $array[] = [
                "name" => $user->username,
                "roles" => $roles
            ];
        }

        return $this->indexResponse($array);
    }
    // **************************************************
    // *************************************************
    // **************Show*******************************
    // *************************************************
    // *************************************************
    public function show($uuid)
    {
       
        
        $user = User::with('roles')->where('uuid',$uuid)->first();

        if ($user) {
            $roles = [];
            foreach ($user->roles as $role) {
                $roles[] = $role->role_name;
            }
            $array = [
                "name" => $user->username,
                "roles" => $roles
            ];
            return $this->showResponse($array);
        } else {
            return $this->notfoundResponse('User not found');
        }
    }
    public function store(Request $request)
    {
        $username = $request->input('username');
        $user = User::where('username', $username)->first();

        if ($user) {
            $roleName = $request->input('role_name');
            $roles = Role::where('role_name', $roleName)->first();

            $user->roles()->attach($roles->id);
            $array = [
                "name" => $user->username,
                "roles" => $roles->role_name
            ];
            return $this->storeResponse($array);
        } else {
            // Return an error message if the user is not found
            return $this->notfoundResponse('User not found');
        }
    }
    public function update(Request $request, $uuid)
    {
        $user = User::where('uuid',$uuid)->first();

        if ($user) {
            $roleName = $request->input('role_name');
            $roles = Role::where('role_name', $roleName)->first();

            $user->roles()->sync($roles->id);
            $array = [
                "name" => $user->username,
                "roles" => $roles->role_name
            ];
            return $this->updateResponse($array);
        } else {
            // Return an error message if the user is not found
            return $this->notfoundResponse('User not found');
        }
    }
    public function destroy($uuid)
    {
        $Role_User = RoleUser::where('uuid',$uuid)->first();

            $Role_User->delete();
            if ($Role_User) {
                return $this->destroyResponse();
            }
            return $this->errorResponse('you con not delete the Role_User', 400);
        
        
    }
 
}
