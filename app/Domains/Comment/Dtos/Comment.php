<?php

namespace App\Domains\Comment\Dtos;

use App\Models\Dto\Entity as Dto;

/**
 * Comment class
 */
class Comment extends Dto
{
    public ?int $articleId = null;
    public ?string $comment = null;

    public function jsonSerialize(): mixed
    {
        return parent::jsonSerialize() + [
                'articleId' => $this->articleId,
                'comment' => $this->comment,
            ];
    }
}
