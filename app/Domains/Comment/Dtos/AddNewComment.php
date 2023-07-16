<?php

namespace App\Domains\Comment\Dtos;

use App\Models\Dto\Entity as Dto;

/**
 * AddNewComment class
 */
class AddNewComment extends Dto
{
    public ?int $articleId = null;
    public ?string $comment = null;

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
                'articleId' => $this->articleId,
                'comment' => $this->comment,
            ];
    }
}
