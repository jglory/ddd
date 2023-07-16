<?php

namespace App\Commands\Bbs;

use App\Commands\Command;
use App\Domains\Comment\Dtos\AddNewComment as AddNewCommentDto;

/**
 * AddNewComment command
 */
class AddNewComment extends Command
{
    public readonly AddNewCommentDto $comment;

    /**
     * @param AddNewCommentDto $comment
     */
    public function __construct(AddNewCommentDto $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        return [
            'comment' => $this->comment->jsonSerialize(),
        ];
    }
}
