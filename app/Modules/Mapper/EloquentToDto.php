<?php

namespace App\Modules\Mapper;

use Illuminate\Database\Eloquent\Model;

/**
 * eloquent 를 dto로 변환하여 주는 유틸리티 클래스
 */
class EloquentToDto extends Mapper
{
    public function create(mixed $in): mixed
    {
        if (is_object($in) === false || $in instanceof Model === false) {
            throw new \InvalidArgumentException('잘못된 인자 형식입니다.');
        }

        return (new (__NAMESPACE__ . '\\EloquentToDto\\' . classNameFromClass(get_class($in)))())->create($in);
    }
}
