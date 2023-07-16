<?php

namespace App\Commands\Bbs;

use App\Commands\Command;
use App\Domains\Article\Dtos\AddNewArticle as AddNewArticleDto;

/**
 * AddNewArticle command
 */
class AddNewArticle extends Command
{
    public readonly AddNewArticleDto $article;

    /**
     * @param AddNewArticleDto $article
     */
    public function __construct(AddNewArticleDto $article)
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
