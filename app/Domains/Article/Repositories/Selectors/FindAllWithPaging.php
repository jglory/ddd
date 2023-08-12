<?php

namespace App\Domains\Article\Repositories\Selectors;

use App\Domains\Article\Eloquents\Article as ArticleEloquent;
use App\Models\Dto\Entity as Dto;
use App\Models\Repository\Selector;
use App\Models\Repository\Specification;
use Closure;
use Illuminate\Support\Collection;

class FindAllWithPaging extends Selector
{
    /**
     * @param Specification $spec
     * @return array|Dto[]
     */
    public function process(Specification $spec): Collection
    {
        $count = ArticleEloquent::count();
        $pageCount = intdiv($count, $spec->pageSize) + ($count % $spec->pageSize > 0 ? 1 : 0);
        if ($spec->page > $pageCount) {
            return collect();
        }

        $skip = ($spec->page - 1) * $spec->pageSize;
        return ArticleEloquent::skip($skip)
            ->limit($spec->pageSize)
            ->get()
            ->map(Closure::bind(
                function ($item) {
                    return $this->mapper->create($item);
                },
                $this)
            );
    }
}
