<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Send response success (200 OK)
     *
     * @param mixed $data
     * @param string $message 
     * @param int $statusCode
     * @return JsonResponse
     */
    public function success($data = null, $message = 'Success', $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Send response error (examples 404 or 500 errors)
     *
     * @param string $message
     * @param mixed $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function error($message = 'Error', $data = null, $statusCode = 400): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Send response no context data (No Content 204)
     *
     * @param string $message پیام
     * @param int $statusCode کد وضعیت HTTP (پیش‌فرض 204)
     * @return JsonResponse
     */
    public function noContent($message = 'No Content', $statusCode = 204): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message
        ], $statusCode);
    }
}
