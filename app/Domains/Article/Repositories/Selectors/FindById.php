<?php

namespace App\Domains\Article\Repositories\Selectors;

use App\Domains\Article\Eloquents\Article as ArticleEloquent;
use App\Models\Dto\Entity as Dto;
use App\Models\Repository\Selector;
use App\Models\Repository\Specification;

class FindById extends Selector
{
    /**
     * @param Specification $spec
     * @return Dto[]
     */
    public function process(Specification $spec): array
    {
        $result = ArticleEloquent::with('comments')
            ->where('id', $spec->id)
            ->get();
        if ($result->isEmpty()) {
            return [];
        }

        return [$this->mapper->create($result[0])];
    }
}
