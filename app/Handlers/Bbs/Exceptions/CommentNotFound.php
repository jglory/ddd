<?php

namespace App\Handlers\Bbs\Exceptions;

use RuntimeException;
use Throwable;

/**
 * CommentNotFound exception
 */
class CommentNotFound extends RuntimeException
{
    public function __construct(string $message = "댓글 정보를 찾을 수 없습니다.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
