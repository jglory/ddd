<?php

namespace App\Http\Transformers;

use App\Models\Http\Transformer;

/**
 * Fail transformer
 */
class Fail extends Transformer
{
    protected function transform(mixed $data): mixed
    {
        return response(
            [
                'status' => 'fail',
                'data' => $data->getMessage(),
            ],
            $data->getCode()
        );
    }
}
