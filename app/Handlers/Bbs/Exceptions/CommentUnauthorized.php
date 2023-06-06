<?php

namespace App\Handlers\Bbs\Exceptions;

use RuntimeException;
use Throwable;

/**
 * CommentUnauthorized exception
 */
class CommentUnauthorized extends RuntimeException
{
    public function __construct(string $message = "댓글에 대한 권한이 없습니다.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
