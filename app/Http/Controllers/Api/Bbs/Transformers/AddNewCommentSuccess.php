<?php

namespace App\Http\Controllers\Api\Bbs\Transformers;

use App\Models\Http\Transformer;

/**
 * AddNewCommentSuccess transformer
 */
class AddNewCommentSuccess extends Transformer
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function process(mixed $data): mixed
    {
        return [
            'status' => 'success',
            'data' => [
                'article' => $data
            ]
        ];
    }
}
