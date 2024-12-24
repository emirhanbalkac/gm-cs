<?php

namespace App\Exceptions\Product;

use App\Exceptions\BaseException;
use Throwable;

class ProductNotFoundException extends BaseException
{
    public function __construct(string $message = "Product not found.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
