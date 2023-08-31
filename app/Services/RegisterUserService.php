<?php

namespace App\Services;

use App\Models\Code;
use App\Models\User;
use Illuminate\Support\Str;


class RegisterUserService implements RegisterUserServiceInterface{
    
    public function registerUser($username, $phone, $collageId)
    {
        
        $user = $this->createUser($username, $phone);
        $codeValue = $this->generateUniqueCode();
        $this->createCode($codeValue, $user->id, $collageId);

        return $user;
    }

    public function generateUniqueCode()
    {
        do {
            $generatedCode = random_int(1000, 999999);
        } while (Code::where('value', $generatedCode)->exists());

        return $generatedCode;
    }

    public function createUser($username, $phone)
    {
        return User::create([
            'uuid' => Str::uuid(),
            'username' => $username,
            'phone' => $phone,
        ]);
    }

    public function createCode($value, $userId, $collageId)
    {
        return Code::create([
            'uuid' => Str::uuid(),
            'value' => $value,
            'user_id' => $userId,
            'collage_id' => $collageId,
        ]);
    }
   
}

