<?php

namespace App\Domains\Customer\Repositories\Selectors;

use App\Domains\Customer\Eloquents\Customer as CustomerEloquent;
use App\Models\Repository\Selector;
use App\Models\Repository\Specification;
use Illuminate\Database\Eloquent\Collection;
use \Closure;

class FindById extends Selector
{
    public function process(Specification $spec)
    {
        /** @var Collection $result */
        $result = CustomerEloquent::with('user')->where('id', $spec->id)->get();

        return $result->map(
            Closure::bind(
                function ($item) {
                    return $this->mapper->create($item);
                },
                $this
            )
        )->toArray();
    }
}
