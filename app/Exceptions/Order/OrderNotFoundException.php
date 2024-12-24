<?php

namespace App\Exceptions\Order;

use App\Exceptions\BaseException;
use Throwable;

class OrderNotFoundException extends BaseException
{
    public function __construct(string $message = "Order not found.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
