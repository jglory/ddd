<?php

namespace App\Http\Controllers\Api\Auth\Transformers;

use App\Models\Http\Transformer;

/**
 * LeaveSuccess transformer
 */
class LeaveSuccess extends Transformer
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
