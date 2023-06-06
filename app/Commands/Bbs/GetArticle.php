<?php

namespace App\Commands\Bbs;

use App\Commands\Command;
use App\Domains\Article\Dtos\GetArticle as GetArticleDto;

/**
 * GetArticle command
 */
class GetArticle extends Command
{
    public readonly GetArticleDto $article;

    /**
     * @param GetArticleDto $article
     */
    public function __construct(GetArticleDto $article)
    {
        $this->article = $article;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'article' => $this->article->jsonSerialize(),
        ];
    }
}
