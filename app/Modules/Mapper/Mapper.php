<?php

namespace App\Modules\Mapper;

/**
 * mapper interface
 */
abstract class Mapper
{
    /**
     * @param mixed $in
     * @return mixed
     */
    abstract public function create(mixed $in): mixed;
}
