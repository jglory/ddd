<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Models\Http\Transformer;

/**
 * LoginSuccess transformer
 */
class LoginSuccess extends Transformer
{
    public function process(mixed $data): mixed
    {
        return [
            'status' => 'success',
            'data' => [
                'token' => $data
            ]
        ];
    }
}
