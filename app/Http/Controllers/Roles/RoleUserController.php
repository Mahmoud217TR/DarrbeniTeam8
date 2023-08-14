<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleUserController extends Controller
{
    use ApiResponse;
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
                "name" => $user->UserName,
                "roles" => $roles
            ];
        }

        return $this->apiResponse($array);
    }
    public function show($id)
    {
        $user = User::with('roles')->find($id);

        if ($user) {
            $roles = [];
            foreach ($user->roles as $role) {
                $roles[] = $role->role_name;
            }
            $array = [
                "name" => $user->UserName,
                "roles" => $roles
            ];
            return $this->apiResponse($array);
        } else {
            return $this->errorResponse('User not found');
        }
    }
    public function store(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $roleName = $request->input('role_name');
            $roles = Role::where('role_name', $roleName)->first();

            $user->roles()->attach($roles->id);
            $array = [
                "name" => $user->UserName,
                "roles" => $roles->role_name
            ];
            return $this->successResponse($array, 'Roles assigned successfully');
        } else {
            // Return an error message if the user is not found
            return $this->errorResponse('User not found');
        }
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $roleName = $request->input('role_name');
            $roles = Role::where('role_name', $roleName)->first();

            $user->roles()->sync($roles->id);
            $array = [
                "name" => $user->UserName,
                "roles" => $roles->role_name
            ];
            return $this->successResponse($array, 'Roles assigned successfully');
        } else {
            // Return an error message if the user is not found
            return $this->errorResponse('User not found');
        }
    }
    public function destroy($id)
    {
        $Role_User = RoleUser::find($id);

        if ($Role_User->user_id === Auth::id()) {
            $Role_User->delete();
            if ($Role_User) {
                return $this->successResponse(null, 'the Role_User deleted');
            }
            return $this->errorResponse('you con not delete the Role_User', 400);
        }
        return $this->errorResponse('you con not delete the Role_User Because you are not authorized', 401);
    }
 
}
