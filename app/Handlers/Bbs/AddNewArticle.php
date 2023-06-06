<?php

namespace App\Handlers\Bbs;

use App\Commands\Command;
use App\Domains\Article\Aggregates\Article as ArticleAggregate;
use App\Domains\Article\Dtos\Article as ArticleDto;
use App\Handlers\Handler;
use App\Models\Repository\Repository;
use Illuminate\Support\Facades\DB;

/**
 * AddNewArticle handler
 */
class AddNewArticle extends Handler
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
        $dto = (new ArticleAggregate($command->article))->toDto();

        DB::beginTransaction();
        try {
            $this->repository->save($dto);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $dto;
    }
}
