<?php

namespace App\Handlers\Auth\Exceptions;

use RuntimeException;
use Throwable;

/**
 * CustomerNotFound exception
 */
class CustomerNotFound extends RuntimeException
{
    public function __construct(string $message = "학생 정보를 찾을 수 없습니다.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
