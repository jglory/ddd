<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Http\Transformers\Ok as OkTransformer;

/**
 * LeaveOk transformer
 */
class LeaveOk extends OkTransformer
{
    protected function transform(mixed $data): mixed
    {
        return parent::transform([
            ['customer' => $data[0]],
            $data[1]
        ]);
    }
}
