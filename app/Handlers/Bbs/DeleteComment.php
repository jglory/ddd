<?php

namespace App\Handlers\Bbs;

use App\Commands\Command;
use App\Domains\Article\Aggregates\Article as ArticleAggregate;
use App\Domains\Article\Repositories\Repository;
use App\Domains\Article\Repositories\Specifications\FindById as ArticleFindByIdSpecification;
use App\Domains\Article\Dtos\Article as ArticleDto;
use App\Domains\Comment\Dtos\Comment as CommentDto;
use App\Domains\Comment\Entities\Comment as CommentEntity;
use App\Handlers\Bbs\Exceptions\ArticleNotFound as ArticleNotFoundException;
use App\Handlers\Bbs\Exceptions\CommentNotFound as CommentNotFoundException;
use App\Handlers\Bbs\Exceptions\CommentUnauthorized as CommentUnauthorizedException;
use App\Handlers\Handler;
use Illuminate\Support\Facades\DB;

/**
 * DeleteComment handler
 */
class DeleteComment extends Handler
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
            /** @var ArticleDto $articleDto */
            $articleDto = $this->repository->findOne(new ArticleFindByIdSpecification($command->comment->articleId));
            if (is_null($articleDto)) {
                throw new ArticleNotFoundException();
            }

            $article = new ArticleAggregate($articleDto);
            $result = $article->deleteComment(
                new CommentEntity(
                    dto(
                        CommentDto::class,
                        [
                            'id' => $command->comment->id,
                            'articleId' => $command->comment->articleId,
                            'comment' => '',
                        ]
                    )
                )
            );
            if ($result === false) {
                throw new CommentNotFoundException();
            }

            $this->repository->save($articleDto = $article->toDto());
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $articleDto;
    }
}
