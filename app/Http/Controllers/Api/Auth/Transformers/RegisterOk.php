<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Http\Transformers\Ok as OkTransformer;

/**
 * RegisterOk transformer
 */
class RegisterOk extends OkTransformer
{
    public function process(mixed $data): mixed
    {
        return parent::process([
            ['customer' => $data[0]],
            $data[1]
            ]);
    }

}
