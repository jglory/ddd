<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Http\Transformers\Ok as OkTransformer;

/**
 * RefreshOk transformer
 */
class RefreshOk extends OkTransformer
{
    protected function transform(mixed $data): mixed
    {
        return parent::transform([
            ['token' => $data[0]],
            $data[1],
        ]);
    }
}
