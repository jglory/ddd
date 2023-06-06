<?php

namespace App\Domains\Comment\Exceptions;

use LogicException;
use Throwable;

/**
 * AlreadyDeleted exception
 */
class AlreadyDeleted extends LogicException
{
    public function __construct(string $message = "이미 삭제된 댓글입니다.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
