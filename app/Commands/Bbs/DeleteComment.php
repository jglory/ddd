<?php

namespace App\Commands\Bbs;

use App\Commands\Command;
use App\Domains\Comment\Dtos\DeleteComment as DeleteCommentDto;

/**
 * DeleteComment command
 */
class DeleteComment extends Command
{
    public readonly int $requesterId;
    public readonly DeleteCommentDto $comment;

    /**
     * @param int $requesterId
     * @param DeleteCommentDto $comment
     */
    public function __construct(int $requesterId, DeleteCommentDto $comment)
    {
        $this->requesterId = $requesterId;
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        return [
            'requesterId' => $this->requesterId,
            'comment' => $this->comment->jsonSerialize(),
        ];
    }
}
