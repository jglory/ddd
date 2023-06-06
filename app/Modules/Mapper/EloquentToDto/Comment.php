<?php

namespace App\Modules\Mapper\EloquentToDto;

use App\Domains\Comment\Dtos\Comment as CommentDto;
use App\Models\Dto\Entity as Dto;

/**
 * eloquent 를 dto로 변환하여 주는 유틸리티 클래스
 */
class Comment extends Base
{
    /**
     * @return Dto
     */
    protected function createDto(): Dto
    {
        return new CommentDto();
    }

    /**
     * @param mixed $in
     * @param mixed $out
     * @return void
     */
    protected function copy(mixed $in, mixed $out): void
    {
        $out->articleId = $in->article_id;
        $out->comment = $in->comment;
    }
}
