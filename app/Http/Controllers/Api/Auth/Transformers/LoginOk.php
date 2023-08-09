<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Http\Transformers\Ok as OkTransformer;

/**
 * LoginOk transformer
 */
class LoginOk extends OkTransformer
{
    protected function transform(mixed $data): mixed
    {
        return parent::transform([
            ['token' => $data[0]],
            $data[1],
        ]);
    }
}
