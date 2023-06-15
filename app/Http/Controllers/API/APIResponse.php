<?php
namespace App\Http\Controllers\API;

trait APIResponse
{
    public function APIResponse($data = null, $errors = null, $status = null, $success = false, $message = null)
    {
        $responseData = [
            'status' => $status,
            'success' => $success,
            'message' => $message,
            'errors' => $errors,
            'data' => $data,
        ];

        return response()->json($responseData, $status);
    }
} 