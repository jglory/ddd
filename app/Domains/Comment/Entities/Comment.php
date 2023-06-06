<?php

namespace App\Domains\Comment\Entities;

use App\Domains\Comment\Dtos\AddNewComment as AddNewCommentDto;
use App\Domains\Comment\Dtos\Comment as CommentDto;
use App\Domains\Comment\Exceptions\AlreadyDeleted as AlreadyDeletedException;
use App\Models\Dto\Dto;
use App\Models\Entity\Entity;
use Illuminate\Support\Carbon;

class Comment extends Entity
{
    protected int $articleId;
    protected string $comment;

    protected function createDto(): Dto
    {
        return new CommentDto();
    }

    protected function isDtoConstructable(Dto $dto): bool
    {
        return $dto instanceof AddNewCommentDto || $dto instanceof CommentDto;
    }

    public function delete()
    {
        if ($this->deletedAt) {
            throw new AlreadyDeletedException();
        }
        $this->deletedAt = Carbon::now();
    }
}
