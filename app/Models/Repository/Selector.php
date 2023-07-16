<?php

namespace App\Models\Repository;

use App\Models\Dto\Entity as Dto;
use App\Modules\Mapper\Mapper;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Collection;

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
     * @return Dto|Collection|null
     */
    abstract public function process(Specification $spec);
}
