<?php

namespace App\Domains\Student\Repositories\Selectors;

use App\Domains\Student\Eloquents\Student as StudentEloquent;
use App\Models\Dto\Entity as Dto;
use App\Models\Repository\Selector;
use App\Models\Repository\Specification;

class FindById extends Selector
{
    public function process(Specification $spec): ?Dto
    {
        $result = StudentEloquent::with('user')->find($spec->id);
        if (is_null($result)) {
            return null;
        }

        return $this->mapper->create($result);
    }
}
