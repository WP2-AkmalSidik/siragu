<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait JsonResponder
{
    /**
     * Return standardized JSON success response.
     */
    public function successResponse($data = null, string $message = 'Success', int $code = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ], $code)->header('Content-Type', 'application/json');
    }

    /**
     * Return standardized JSON error response.
     */
    public function errorResponse($data = null, string $message = 'Error', int $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'success' => false,
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ], $code)->header('Content-Type', 'application/json');
    }

    public function errorValidateResponse($error = null, string $message = 'Error', int $code = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'code'    => $code,
            'message' => $message,
            'errors'  => $error,
        ], $code)->header('Content-Type', 'application/json');
    }
}
