<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Http\Transformers\Ok as OkTransformer;

/**
 * RefreshOk transformer
 */
class RefreshOk extends OkTransformer
{
    public function process(mixed $data): mixed
    {
        return parent::process([
            ['token' => $data[0]],
            $data[1],
        ]);
    }
}
