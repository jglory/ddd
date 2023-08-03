<?php

namespace App\Domains\Customer\Repositories;

use App\Domains\Customer\Repositories\Selectors\FindById as FindByIdSelector;
use App\Domains\Customer\Repositories\Specifications\FindById as FindByIdSpecification;
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

    /**
     * @param Dto $dto
     * @return array
     */
    protected function serialize($dto): array
    {
        return [$dto, $dto->user];
    }
}
