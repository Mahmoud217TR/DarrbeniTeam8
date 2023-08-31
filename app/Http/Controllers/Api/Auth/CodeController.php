<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\CodeRequest;
use App\Http\Resources\CodeResource;
use App\Models\Code;
use App\Models\Collage;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CodeController extends Controller
{
    use ApiResponseTrait;

    public function store(CodeRequest $request)
    {
        $user=User::where('username',$request->user_name)->first();
        $collage=Collage::where('name',$request->collage_name)->first();
        
        $code = Code::create([
            'uuid' => Str::uuid(),
            'value' => random_int(1000, 9999),
            'user_id'=>$user->id,
            'collage_id'=>$collage->id,
        ]);


        if ($code) {
          
            return $this->successResponse( 'the code  Save',   new CodeResource($code),);
        }
        return $this->errorResponse('the code Not Save');
    }

}
