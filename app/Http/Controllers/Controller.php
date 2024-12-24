<?php

namespace App\Http\Controllers;

use App\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    public function sendResponse(array|object $data = null, ?string $message = null, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json(
          data:   ResponseUtil::sendResponse($data, $message),
          status: $status
        );
    }
}
