<?php

namespace App\Handlers\Bbs;

use App\Commands\Command;
use App\Domains\Article\Dtos\Article as ArticleDto;
use App\Domains\Article\Repositories\Specifications\FindAllWithPaging as FindAllWithPagingSpecification;
use App\Handlers\Handler;
use App\Handlers\Bbs\Exceptions\ArticleNotFound as ArticleNotFoundException;
use App\Models\Repository\Repository;

/**
 * GetArticleList handler
 */
class GetArticleList extends Handler
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
     * @return ArticleDto[]
     */
    public function process(Command $command): array
    {
        $result = $this->repository->find(new FindAllWithPagingSpecification($command->page, $command->pageSize));
        if (empty($result)) {
            throw new ArticleNotFoundException();
        }

        return $result;
    }
}
