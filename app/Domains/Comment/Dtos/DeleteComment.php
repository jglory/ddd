<?php

namespace App\Domains\Comment\Dtos;

use App\Models\Dto\Entity as Dto;

/**
 * DeleteComment class
 */
class DeleteComment extends Dto
{
    public ?int $articleId = null;

    public function jsonSerialize(): mixed
    {
        return parent::jsonSerialize() + [
                'articleId' => $this->articleId,
            ];
    }
}
