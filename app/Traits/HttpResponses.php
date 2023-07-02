<?php

namespace App\Traits;


trait HttpResponses{

    public function response(string $message, string|int $status, array $data = [], array $errors = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data,
            'errors' => $errors
        ], $status);
    }

    public function error(string $message,  string|int $status, array $data = [], array $errors = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data,
            'errors' => $errors
        ], $status);
    }
}