<?php

namespace App\Domains\Article\Repositories\Specifications;

use App\Models\Repository\Specification;

class FindAllWithPaging extends Specification
{
    public readonly int $page;
    public readonly int $pageSize;

    /**
     * @param int $page
     * @param int $pageSize
     */
    public function __construct(int $page, int $pageSize)
    {
        $this->page = $page;
        $this->pageSize = $pageSize;
    }
}
