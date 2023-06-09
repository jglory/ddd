<?php

namespace App\Domains\Student\Repositories;

use App\Domains\Student\Repositories\Selectors\FindById as FindByIdSelector;
use App\Domains\Student\Repositories\Specifications\FindById as FindByIdSpecification;
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
    }

    protected function serialize(?Dto $dto): array
    {
        return [$dto, $dto->user];
    }
}
