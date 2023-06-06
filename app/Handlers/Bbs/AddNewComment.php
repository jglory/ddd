<?php

namespace App\Handlers\Bbs;

use App\Commands\Command;
use App\Domains\Article\Aggregates\Article as ArticleAggregate;
use App\Domains\Article\Dtos\Article as ArticleDto;
use App\Domains\Article\Repositories\Specifications\FindById as ArticleFindByIdSpecification;
use App\Domains\Comment\Entities\Comment as CommentEntity;
use App\Domains\Comment\Dtos\Comment as CommentDto;
use App\Handlers\Bbs\Exceptions\ArticleNotFound as ArticleNotFoundException;
use App\Handlers\Handler;
use App\Models\Repository\Repository;
use Illuminate\Support\Facades\DB;

/**
 * AddNewComment handler
 */
class AddNewComment extends Handler
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
     * @return CommentDto|null
     */
    public function process(Command $command): ?ArticleDto
    {
        DB::beginTransaction();
        try {
            $articleDto = $this->repository->findOne(new ArticleFindByIdSpecification($command->comment->articleId));
            if (is_null($articleDto)) {
                throw new ArticleNotFoundException();
            }

            $article = new ArticleAggregate($articleDto);
            $article->addNewComment(new CommentEntity($command->comment));
            $this->repository->save($articleDto = $article->toDto());
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $articleDto;
    }
}
