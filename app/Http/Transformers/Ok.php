<?php

namespace App\Http\Transformers;

use App\Models\Http\Transformer;
use App\Values\Http\StatusCode as HttpStatusCode;
use InvalidArgumentException;

/**
 * Ok transformer
 */
class Ok extends Transformer
{
    protected function transform(mixed $data): mixed
    {
        if ($data[1] instanceof HttpStatusCode === false) {
            throw new InvalidArgumentException('잘못된 입력값입니다.');
        }
        return response(
            [
                'status' => 'ok',
                'data' => $data[0],
            ],
            (string)$data[1]
        );
    }
}
