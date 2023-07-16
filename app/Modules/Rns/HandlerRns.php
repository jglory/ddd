<?php

namespace App\Modules\Rns;

use Illuminate\Support\Facades\App;

/**
 * HandlerRns class
 */
class HandlerRns extends Rns
{
    /**
     * identifier 에 관련된 resource 를 돌려준다.
     *
     * @param mixed $identifier
     *
     * @return mixed
     */
    public function lookup(mixed $identifier): mixed
    {
        return App::make(str_replace('Commands', 'Handlers', get_class($identifier)));
    }
}
