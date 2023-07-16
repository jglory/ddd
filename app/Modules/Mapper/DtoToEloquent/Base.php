<?php

namespace App\Modules\Mapper\DtoToEloquent;

use App\Models\Dto\Entity as Dto;
use App\Modules\Mapper\Mapper;
use Illuminate\Database\Eloquent\Model;

/**
 * dto 를 eloquent로 변환하여 주는 유틸리티 클래스
 */
abstract class Base extends Mapper
{
    abstract protected function createEloquent(): Model;

    abstract protected function copy(mixed $in, mixed $out): void;

    public function create(mixed $in): mixed
    {
        if (is_object($in) === false || $in instanceof Dto === false) {
            throw new \InvalidArgumentException('잘못된 인자 형식입니다.');
        }

        $out = $this->createEloquent();
        $out->id = $in->id;
        $out->created_at = $in->createdAt;
        $out->updated_at = $in->updatedAt;
        $out->deleted_at = $in->deletedAt;
        $this->copy($in, $out);

        return $out;
    }
}
