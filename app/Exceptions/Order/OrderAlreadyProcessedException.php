<?php

namespace App\Exceptions\Order;

use App\Exceptions\BaseException;
use Throwable;

class OrderAlreadyProcessedException extends BaseException
{
    public function __construct(string $message = "Order already processed.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
