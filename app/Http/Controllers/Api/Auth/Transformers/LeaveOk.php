<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Http\Transformers\Ok as OkTransformer;

/**
 * LeaveOk transformer
 */
class LeaveOk extends OkTransformer
{
    public function process(mixed $data): mixed
    {
        return parent::process([
            ['customer' => $data[0]],
            $data[1]
        ]);
    }
}
