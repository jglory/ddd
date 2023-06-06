<?php

namespace App\Handlers\Bbs;

use App\Commands\Command;
use App\Domains\Article\Dtos\Article as ArticleDto;
use App\Domains\Article\Repositories\Specifications\FindById as FindByIdSpecification;
use App\Handlers\Handler;
use App\Handlers\Bbs\Exceptions\ArticleNotFound as ArticleNotFoundException;
use App\Models\Repository\Repository;

/**
 * GetArticle handler
 */
class GetArticle extends Handler
{
    private Repository $repository;

    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Command $command
     *
     * @return ArticleDto|null
     */
    public function process(Command $command): ?ArticleDto
    {
        $dto = $this->repository->findOne(new FindByIdSpecification($command->article->id));
        if (is_null($dto)) {
            throw new ArticleNotFoundException();
        }

        return $dto;
    }
}
