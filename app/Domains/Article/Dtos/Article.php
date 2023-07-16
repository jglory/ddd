<?php

namespace App\Domains\Article\Dtos;

use App\Domains\Comment\Dtos\Comment as CommentDto;
use App\Models\Dto\Entity as Dto;

/**
 * Article class
 */
class Article extends Dto
{
    public ?int $writerId = null;
    public ?string $title = null;
    public ?string $content = null;
    /** @var CommentDto[] */
    public array $comments = [];

    public function jsonSerialize(): mixed
    {
        return parent::jsonSerialize() + [
                'writerId' => $this->writerId,
                'title' => $this->title,
                'content' => $this->content,
                'comments' => $this->comments,
            ];
    }

    public function __clone(): void
    {
        $this->comments = array_map(function ($item) {
            return clone $item;
        }, $this->comments);
    }
}
