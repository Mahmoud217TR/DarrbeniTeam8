<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Code;
use App\Models\Collage;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function register(RegisterRequest $request)
    {
        // Find the collage based on the provided name
        $collage = Collage::where('name', $request->collage_name)->first();

        if (!$collage) {
            return $this->notfoundResponse('Collage Not Found');
        }

        $user = User::create([
            'uuid' => Str::uuid(),
            'username' => $request->username,
            'phone' => $request->phone,
            'collage_id' => $collage->id,
        ]);

        // Create a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->registerResponse($user->username);
    }




    public function login(LoginRequest $request)
    {
        // Retrieve the user by username
        $user = User::where('username', $request->username)->first();

        // If the user doesn't exist or the code is invalid
        if (!$user) {
            return $this->notfoundResponse('User Not Found');
        }
       if($user->codes->value == $request->code){

        // Generate a token for the logged-in user
        $token = $user->createToken('auth_token')->plainTextToken;
        $data = [
            'username' => $user->username,
            'collage' => $user->collages->name
        ];
        return $this->loginResponse($data, $token);
    }
    return $this->notfoundResponse('Code Not found');
    }

    public function logout()
    {
        // Revoke the current user's access token
        auth()->user::currentAccessToken()->delete();

        return $this->logoutResponse('LogOut Successfully');
    }

    // Helper function to check if the provided code is valid for the user
    private function isValidCode(User $user, $providedCode)
    {
        $correctCode = Code::where('user_id', $user->id)
            ->where('value', $providedCode)
            ->exists();

        return $correctCode;
    }

    public function show()
    {
        $user = User::all();
        return $user;
    }
}
