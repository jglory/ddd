<?php

namespace App\Modules\Mapper\EloquentToDto;

use App\Domains\Article\Dtos\Article as ArticleDto;
use App\Models\Dto\Entity as Dto;
use Closure;

/**
 * eloquent 를 dto로 변환하여 주는 유틸리티 클래스
 */
class Article extends Base
{
    /**
     * @return Dto
     */
    protected function createDto(): Dto
    {
        return new ArticleDto();
    }

    /**
     * @param mixed $in
     * @param mixed $out
     * @return void
     */
    protected function copy(mixed $in, mixed $out): void
    {
        $out->writerId = $in->writer_id;
        $out->title = $in->title;
        $out->content = $in->content;
        $out->comments = $in->comments->map(
            Closure::bind(function ($item) {
                return $this->mapper->create($item);
            }, $this)
        )->toArray();
    }
}
