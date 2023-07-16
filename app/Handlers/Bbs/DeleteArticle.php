<?php

namespace App\Handlers\Bbs;

use App\Commands\Command;
use App\Domains\Article\Aggregates\Article as ArticleAggregate;
use App\Domains\Article\Dtos\Article as ArticleDto;
use App\Domains\Article\Repositories\Repository;
use App\Domains\Article\Repositories\Specifications\FindById as FindByIdSpecification;
use App\Handlers\Bbs\Exceptions\ArticleNotFound as ArticleNotFoundException;
use App\Handlers\Bbs\Exceptions\ArticleUnauthorized as ArticleUnauthorizedException;
use App\Handlers\Handler;
use Illuminate\Support\Facades\DB;

/**
 * DeleteArticle handler
 */
class DeleteArticle extends Handler
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
        DB::beginTransaction();
        try {
            $dto = $this->repository->findOne(new FindByIdSpecification($command->article->id));
            if (is_null($dto)) {
                throw new ArticleNotFoundException();
            }
            if ($dto->writerId !== $command->requesterId) {
                throw new ArticleUnauthorizedException();
            }

            $article = new ArticleAggregate($dto);
            $article->delete();

            $this->repository->save($dto = $article->toDto());
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $dto;
    }
}
