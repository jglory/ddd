<?php

namespace App\Handlers\Bbs\Exceptions;

use RuntimeException;
use Throwable;

/**
 * ArticleNotFound exception
 */
class ArticleNotFound extends RuntimeException
{
    public function __construct(string $message = "게시물 정보를 찾을 수 없습니다.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
