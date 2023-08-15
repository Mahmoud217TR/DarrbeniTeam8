<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\CodeRequest;
use App\Http\Resources\CodeResource;
use App\Models\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
{
 

    public function store(CodeRequest $request)
    {
        
        $code = Code::create([
            'value' => ,
            'user_id'=>$request->user_id,
            'collage_id'=>$request->collage_id
        ]);


        if ($code) {
            $data=[
                new CodeResource($code),
                'user'=>$code->users->UserName,
                'collage'=>$code->collages->name

            ];
            return $this->successResponse($data, 'the code  Save');
        }
        return $this->errorResponse('the code Not Save');
    }

}
