<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\Code;
use App\Models\Collage;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Traits\AuthTrait;
use Illuminate\Support\Str;
use App\Services\RegisterUserServiceInterface;


class AuthController extends Controller
{
    use ApiResponseTrait;
    
    private $registrationService;

    public function __construct(RegisterUserServiceInterface $registrationService)
    {
        $this->registrationService = $registrationService;
    }
    public function register(RegisterRequest $request)
    {
        try {
            $collage = Collage::where('name', $request->collage_name)->first();
    
            if (!$collage) {
                return $this->notfoundResponse('Collage Not Found');
            }
            
            $user = $this->registrationService->registerUser(
                $request->username,
                $request->phone,
                $collage->id
            );
            
            return $this->registerResponse(new UserResource($user));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage()); 
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = User::with('codes.collage')->where('username', $request->username)->first();
    
            if (!$user || $user->codes->value != $request->code) {
                return $this->notfoundResponse('Invalid Credentials');
            }
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return $this->loginResponse(new LoginResource($user), $token);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage()); 
        }
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            
            return $this->logoutResponse('Logout Successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage()); 
        }
    }

   
}
