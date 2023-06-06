<?php

namespace App\Domains\Article\Exceptions;

use LogicException;
use Throwable;

/**
 * CommentExists exception
 */
class CommentExists extends LogicException
{
    public function __construct(string $message = "동일한 댓글이 존재합니다.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
