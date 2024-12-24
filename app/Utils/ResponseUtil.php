<?php

namespace App\Utils;

class ResponseUtil
{
    public static function sendResponse(array|object $data = null, ?string $message = null): array
    {
        return [
          'success' => true,
          'data'    => $data,
          'message' => $message
        ];
    }

    public static function sendError(?string $message = null, ?array $errors = null): array
    {
        return [
          'success' => false,
          'message' => $message,
          'errors'  => $errors
        ];
    }
}