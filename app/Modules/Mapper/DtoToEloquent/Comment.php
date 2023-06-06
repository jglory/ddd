<?php

namespace App\Modules\Mapper\DtoToEloquent;

use App\Domains\Comment\Eloquents\Comment as CommentEloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * dto 를 eloquent로 변환하여 주는 유틸리티 클래스
 */
class Comment extends Base
{
    protected function createEloquent(): Model
    {
        return new CommentEloquent();
    }

    protected function copy(mixed $in, mixed $out): void
    {
        $out->article_id = $in->articleId;
        $out->comment = $in->comment;
    }
}
