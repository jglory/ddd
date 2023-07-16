<?php

namespace App\Domains\Article\Repositories;

use App\Domains\Article\Repositories\Selectors\FindAllWithPaging as FindAllWithPagingSelector;
use App\Domains\Article\Repositories\Selectors\FindById as FindByIdSelector;
use App\Domains\Article\Repositories\Specifications\FindAllWithPaging as FindAllWithPagingSpecification;
use App\Domains\Article\Repositories\Specifications\FindById as FindByIdSpecification;
use App\Models\Dto\Entity as Dto;
use App\Models\Repository\Repository as Base;
use App\Modules\Database\Factory;

class Repository extends Base
{
    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        parent::__construct($factory);

        $this->selectors[FindByIdSpecification::class] = new FindByIDSelector();
        $this->selectors[FindAllWithPagingSpecification::class] = new FindAllWithPagingSelector();
    }

    /**
     * @param Dto|Dto[] $data
     * @return Dto[]
     */
    protected function serialize($data): array
    {
        $result = [];

        if (is_array($data) === false) {
            $data = [$data];
        }

        array_walk($data, function (&$item) use (&$result) {
            $result[] = $item;
            array_walk($item->comments, function (&$item) use (&$result) {
                $result[] = $item;
            });
        });

        return $result;
    }
}
