<?php

namespace App\Modules\Mapper\EloquentToDto;

use App\Domains\User\Dtos\User as UserDto;
use App\Models\Dto\Entity as Dto;

/**
 * eloquent 를 dto로 변환하여 주는 유틸리티 클래스
 */
class User extends Base
{
    protected function createDto(): Dto
    {
        return new UserDto();
    }

    protected function copy(mixed $in, mixed $out): void
    {
        $out->name = $in->name;
        $out->email = $in->email;
        $out->emailVerifiedAt = $in->email_verified_at;
        $out->password = $in->password;
        $out->rememberToken = $in->remember_token;
    }
}
