<?php

namespace App\Traits;

trait ApiResponse
{
    public function success($data = null, string $message = 'Success', int $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function error(string $message = 'Error', int $code = 400, $errors = null)
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    public function respond($data, int $code = 200)
    {
        return response()->json($data, $code);
    }
}