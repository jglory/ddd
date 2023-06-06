<?php

namespace App\Domains\User\Exceptions;

use LogicException;
use Throwable;

/**
 * AlreadyLeaved exception
 */
class AlreadyLeaved extends LogicException
{
    public function __construct(string $message = "이미 탈퇴한 사용자입니다.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
