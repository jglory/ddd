<?php

namespace App\Modules\Mapper\DtoToEloquent;

use App\Domains\Article\Eloquents\Article as ArticleEloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * dto 를 eloquent로 변환하여 주는 유틸리티 클래스
 */
class Article extends Base
{
    protected function createEloquent(): Model
    {
        return new ArticleEloquent();
    }

    protected function copy(mixed $in, mixed $out): void
    {
        $out->writer_id = $in->writerId;
        $out->title = $in->title;
        $out->content = $in->content;
    }
}
