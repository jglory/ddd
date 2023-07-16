<?php

namespace App\Modules\Mapper\DtoToEloquent;

use App\Domains\Customer\Eloquents\Customer as CustomerEloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * dto 를 eloquent로 변환하여 주는 유틸리티 클래스
 */
class Customer extends Base
{
    protected function createEloquent(): Model
    {
        return new CustomerEloquent();
    }

    protected function copy(mixed $in, mixed $out): void
    {
        $out->user_id = $in->user->id;
    }
}
