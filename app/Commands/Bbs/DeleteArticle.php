<?php

namespace App\Commands\Bbs;

use App\Commands\Command;
use App\Domains\Article\Dtos\DeleteArticle as DeleteArticleDto;

/**
 * DeleteArticle command
 */
class DeleteArticle extends Command
{
    public readonly int $requesterId;
    public readonly DeleteArticleDto $article;

    /**
     * @param int $requesterId
     * @param DeleteArticleDto $article
     */
    public function __construct(int $requesterId, DeleteArticleDto $article)
    {
        $this->requesterId = $requesterId;
        $this->article = $article;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'requesterId' => $this->requesterId,
            'article' => $this->article->jsonSerialize(),
        ];
    }
}
