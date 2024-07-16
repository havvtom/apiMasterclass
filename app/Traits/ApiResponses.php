<?php
namespace App\Traits;
trait ApiResponses{

    protected function ok($message, $data = []){
       return $this->successResponse($message, $data, 200);
    }
    protected function successResponse($message, $data, $code = 200){
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $code
        ], $code);
    }

    protected function error($message, $code){
        return response()->json([
            'message' => $message,
            'status' => $code
        ], $code);
    }

}
