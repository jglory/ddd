<?php

namespace App\Handlers\Bbs\Exceptions;

use RuntimeException;
use Throwable;

/**
 * ArticleUnauthorized exception
 */
class ArticleUnauthorized extends RuntimeException
{
    public function __construct(string $message = "게시물에 대한 권한이 없습니다.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
