<?php

namespace App\Modules\Mapper\EloquentToDto;

use App\Domains\Student\Dtos\Student as StudentDto;
use App\Models\Dto\Entity as Dto;
use Illuminate\Support\Facades\App;

/**
 * eloquent 를 dto로 변환하여 주는 유틸리티 클래스
 */
class Student extends Base
{
    protected function createDto(): Dto
    {
        return new StudentDto();
    }

    protected function copy(mixed $in, mixed $out): void
    {
        $out->user = App::make(config('mapper.eloquent-to-dto'))->create($in->user);
    }
}
