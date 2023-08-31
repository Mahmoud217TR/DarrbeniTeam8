<?php

namespace App\Services;

use App\Models\Code;
use App\Models\User;

interface RegisterUserServiceInterface{

    public function generateUniqueCode();
    public function createUser($username, $phone) ;
    public function createCode($value, $userId, $collageId) ;
}