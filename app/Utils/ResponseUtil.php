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
}