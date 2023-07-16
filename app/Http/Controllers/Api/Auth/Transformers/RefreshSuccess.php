<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Models\Http\Transformer;

/**
 * RefreshSuccess transformer
 */
class RefreshSuccess extends Transformer
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
