<?php

namespace App\Http\Exceptions;

use App\Values\Http\StatusCode as HttpStatusCode;
use Exception as Base;
use Throwable;

class Exception extends Base
{
    public function __construct(string $message, HttpStatusCode $statusCode, ?Throwable $previous = null)
    {
        parent::__construct($message, $statusCode->code, $previous);
    }
}
