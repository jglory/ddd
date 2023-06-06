<?php

namespace App\Models\Repository;

use App\Models\Dto\Entity as Dto;
use App\Modules\Mapper\Mapper;
use Illuminate\Support\Facades\App;

abstract class Inserter
{
    protected Mapper $mapper;

    /**
     */
    public function __construct()
    {
        $this->mapper = App::make(config('mapper.dto-to-eloquent'));
    }

    /**
     * @param Dto $dto
     *
     * @return void
     */
    abstract public function process(Dto $dto): void;
}
