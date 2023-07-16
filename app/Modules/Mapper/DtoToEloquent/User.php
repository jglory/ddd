<?php

namespace App\Modules\Mapper\DtoToEloquent;

use App\Domains\User\Eloquents\User as UserEloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * dto 를 eloquent로 변환하여 주는 유틸리티 클래스
 */
class User extends Base
{
    protected function createEloquent(): Model
    {
        return new UserEloquent();
    }

    protected function copy(mixed $in, mixed $out): void
    {
        $out->name = $in->name;
        $out->email = $in->email;
        $out->email_verified_at = $in->emailVerifiedAt;
        $out->password = $in->password;
        $out->remember_token = $in->rememberToken;
    }
}
