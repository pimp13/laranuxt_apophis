<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
    public function success($data = null, $message = 'Success', $statusCode = Response::HTTP_OK): JsonResponse
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
    public function error($message = 'Error', $data = null, $statusCode = Response::HTTP_NOT_FOUND): JsonResponse
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
     * @param string $message
     * @param int $statusCode 
     * @return JsonResponse
     */
    public function noContent($message = 'No Content', $statusCode = Response::HTTP_NO_CONTENT): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message
        ], $statusCode);
    }
}
