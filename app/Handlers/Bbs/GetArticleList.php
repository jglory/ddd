<?php

namespace App\Handlers\Bbs;

use App\Commands\Command;
use App\Domains\Article\Repositories\Specifications\FindAllWithPaging as FindAllWithPagingSpecification;
use App\Handlers\Handler;
use App\Handlers\Bbs\Exceptions\ArticleNotFound as ArticleNotFoundException;
use App\Models\Repository\Repository;
use Illuminate\Support\Collection;

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
     * @return Collection
     */
    public function process(Command $command): Collection
    {
        $result = $this->repository->find(new FindAllWithPagingSpecification($command->page, $command->pageSize));
        if ($result->isEmpty()) {
            throw new ArticleNotFoundException();
        }

        return $result;
    }
}
