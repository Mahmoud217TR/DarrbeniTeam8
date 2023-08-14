<?php
namespace App\Traits;

trait ApiResponseTrait
{
    protected function apiResponse($success, $message, $data = null, $statusCode = 200)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function successResponse($message, $data = null, $statusCode = 200)
    {
        return $this->apiResponse(true, $message, $data, $statusCode);
    }

    protected function errorResponse($message, $statusCode = 400)
    {
        return $this->apiResponse(false, $message, null, $statusCode);
    }

    protected function notfoundResponse($message){
        return response()->json([
            'status' => false,
            'message' => $message,
            'code' => 401
        ]);
    }



    //////////////////   AUTH     ///////////////////////////
    protected function loginResponse($data, $token)
    {
       
        return response()->json([
            'status' => true,
            'message' => 'Login Successfully',
            'data' => $data,
            'token' => $token,
            'code' => 200
        ]);
    }

    protected function registerResponse($data)
    {
        return response()->json([
            'status'=>true,
            'message' => 'register successfully',
            'data' => $data,
            'code' => 201

        ]);
    }

    protected function logoutResponse($message)
    {
        return $this->successResponse($message,['code'=>200]);
    }
}
