<?php

namespace App\Domains\Customer\Repositories\Selectors;

use App\Domains\Customer\Eloquents\Customer as CustomerEloquent;
use App\Models\Dto\Entity as Dto;
use App\Models\Repository\Selector;
use App\Models\Repository\Specification;

class FindById extends Selector
{
    public function process(Specification $spec): ?Dto
    {
        $result = CustomerEloquent::with('user')->find($spec->id);
        if (is_null($result)) {
            return null;
        }

        return $this->mapper->create($result);
    }
}
