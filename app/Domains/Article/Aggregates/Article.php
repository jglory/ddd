<?php

namespace App\Domains\Article\Aggregates;

use App\Domains\Article\Dtos\AddNewArticle as CreateArticleDto;
use App\Domains\Article\Dtos\Article as ArticleDto;
use App\Domains\Article\Exceptions\AlreadyDeleted as AlreadyDeletedException;
use App\Domains\Article\Exceptions\CommentExists as CommentExistsException;
use App\Domains\Comment\Entities\Comment as CommentEntity;
use App\Models\Aggregate\Aggregate;
use App\Models\Dto\Dto;
use Illuminate\Support\Carbon;

/**
 * Article aggregate
 */
class Article extends Aggregate
{
    private int $writerId;
    private string $title;
    private string $content;
    /** @var CommentEntity[] */
    private array $comments = [];

    public function delete()
    {
        if ($this->deletedAt) {
            throw new AlreadyDeletedException();
        }

        $this->deletedAt = Carbon::now();
    }

    public function addNewComment(CommentEntity $comment)
    {
        if (array_search($comment, $this->comments) !== false) {
            throw new CommentExistsException();
        }
        $this->comments[] = $comment;
    }

    public function deleteComment(CommentEntity $comment): bool
    {
        $result = array_filter($this->comments, function ($item) use($comment) {
            return $item->id() === $comment->id();
        });

        if (empty($result)) {
            return false;
        }

        $result[0]->delete();
        return true;
    }

    protected function isDtoConstructable(Dto $dto): bool
    {
        return $dto instanceof CreateArticleDto || $dto instanceof ArticleDto;
    }

    protected function initialize(Dto $dto): void
    {
        $this->writerId = $dto->writerId;
        $this->title = $dto->title;
        $this->content = $dto->content;
        $this->comments = isset($dto->comments) ?
            array_map(function ($item) {
                return new CommentEntity($item);
            }, $dto->comments)
            : [];
    }

    public function toDto(): Dto
    {
        $dto = new ArticleDto();
        $dto->id = $this->id;
        $dto->createdAt = $this->createdAt;
        $dto->updatedAt = $this->updatedAt;
        $dto->deletedAt = $this->deletedAt;
        $dto->writerId = $this->writerId;
        $dto->title = $this->title;
        $dto->content = $this->content;
        $dto->comments = array_map(function ($item) {
            return $item->toDto();
        }, $this->comments);

        return $dto;
    }
}
