<?php

namespace App\Domains\Article\Exceptions;

use LogicException;
use Throwable;

/**
 * AlreadyDeleted exception
 */
class AlreadyDeleted extends LogicException
{
    public function __construct(string $message = "이미 삭제된 게시물입니다.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
