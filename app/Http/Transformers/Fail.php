<?php

namespace App\Http\Transformers;

use App\Models\Http\Transformer;

/**
 * Fail transformer
 */
class Fail extends Transformer
{
    public function process(mixed $data): mixed
    {
        return response(
            [
                'status' => 'fail',
                'message' => $data->getMessage(),
            ],
            $data->getCode()
        );
    }
}
