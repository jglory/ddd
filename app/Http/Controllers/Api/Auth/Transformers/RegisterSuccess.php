<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Models\Http\Transformer;

/**
 * RegisterSuccess transformer
 */
class RegisterSuccess extends Transformer
{
    public function process(mixed $data): mixed
    {
        return [
            'status' => 'success',
            'data' => [
                'customer' => $data
            ]
        ];
    }
}
