<?php

namespace App\Http\Transformers;

use App\Models\Http\Transformer;
use App\Values\Http\StatusCode as HttpStatusCode;

/**
 * Ok transformer
 */
class Ok extends Transformer
{
    public function process(mixed $data, HttpStatusCode $code = new HttpStatusCode(HttpStatusCode::HTTP_OK)): mixed
    {
        return response(
            [
                'status' => 'ok',
                'data' => $data,
            ],
            $code
        );
    }
}
