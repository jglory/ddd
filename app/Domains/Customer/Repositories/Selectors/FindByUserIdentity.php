<?php

namespace App\Domains\Customer\Repositories\Selectors;

use App\Domains\Customer\Eloquents\Customer as CustomerEloquent;
use App\Domains\User\Eloquents\User as UserEloquent;
use App\Models\Repository\Selector;
use App\Models\Repository\Specification;
use Closure;
use Illuminate\Support\Collection;

class FindByUserIdentity extends Selector
{
    public function process(Specification $spec): Collection
    {
        return CustomerEloquent::with('user')
            ->where('user_id', function ($query) use ($spec) {
                $query->select('id')->from((new UserEloquent())->getTable())->where('email', $spec->email);
            })
            ->map(
                Closure::bind(
                    function ($item) {
                        return $this->mapper->create($item);
                    },
                    $this
                )
            );
    }
}
