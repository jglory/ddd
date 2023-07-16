<?php

namespace App\Domains\Article\Dtos;

use App\Models\Dto\Entity as Dto;

/**
 * AddNewArticle class
 */
class AddNewArticle extends Dto
{
    public ?int $writerId = null;
    public ?string $title = null;
    public ?string $content = null;

    public function jsonSerialize(): mixed
    {
        return parent::jsonSerialize() + [
                'writerId' => $this->writerId,
                'title' => $this->title,
                'content' => $this->content,
            ];
    }
}
