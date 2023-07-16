<?php

namespace App\Domains\Customer\Repositories\Selectors;

use App\Domains\Customer\Eloquents\Customer as CustomerEloquent;
use App\Domains\User\Eloquents\User as UserEloquent;
use App\Models\Dto\Entity as Dto;
use App\Models\Repository\Selector;
use App\Models\Repository\Specification;

class FindByUserIdentity extends Selector
{
    public function process(Specification $spec): ?Dto
    {
        $result = CustomerEloquent::with('user')
            ->where('user_id', function ($query) use ($spec) {
                $query->select('id')->from((new UserEloquent())->getTable())->where('email', $spec->email);
            })->first();
        if (is_null($result)) {
            return null;
        }

        return $this->mapper->create($result);
    }
}
