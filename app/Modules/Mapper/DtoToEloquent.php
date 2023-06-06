<?php

namespace App\Modules\Mapper;

use App\Models\Dto\Entity as Dto;

/**
 * dto 를 eloquent로 변환하여 주는 유틸리티 클래스
 */
class DtoToEloquent extends Mapper
{
    public function create(mixed $in): mixed
    {
        if (is_object($in) === false || $in instanceof Dto === false) {
            throw new \InvalidArgumentException('잘못된 인자 형식입니다.');
        }

        return (new (__NAMESPACE__ . '\\DtoToEloquent\\' . classNameFromClass(get_class($in)))())->create($in);
    }
}
