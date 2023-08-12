<?php

namespace App\Models\Repository;

use App\Modules\Mapper\Mapper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Collection;

abstract class Selector
{
    protected Mapper $mapper;

    /**
     */
    public function __construct()
    {
        $this->mapper = App::make(config('mapper.eloquent-to-dto'));
    }

    /**
     * @param Specification $spec
     *
     * @return Collection
     */
    abstract public function process(Specification $spec): Collection;
}
