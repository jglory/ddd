<?php

namespace App\Domains\Article\Repositories\Specifications;

use App\Models\Repository\Specification;

class FindById extends Specification
{
    public readonly int $id;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
