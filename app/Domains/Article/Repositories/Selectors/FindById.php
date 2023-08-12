<?php

namespace App\Domains\Article\Repositories\Selectors;

use App\Domains\Article\Eloquents\Article as ArticleEloquent;
use App\Models\Repository\Selector;
use App\Models\Repository\Specification;
use Closure;
use Illuminate\Support\Collection;

class FindById extends Selector
{
    /**
     * @param Specification $spec
     * @return Collection
     */
    public function process(Specification $spec): Collection
    {
        return ArticleEloquent::with('comments')
            ->where('id', $spec->id)
            ->get()
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
