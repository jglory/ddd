<?php

namespace App\Modules\Rns;

/**
 * Rns class
 */
abstract class Rns
{
    /**
     * identifier 에 관련된 resource 를 돌려준다.
     *
     * @param mixed $identifier
     *
     * @return mixed
     */
    abstract public function lookup(mixed $identifier): mixed;
}
