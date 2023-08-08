<?php

namespace App\Http\Controllers\Api\Bbs\Transformers;

use App\Http\Transformers\Ok as OkTransformer;

/**
 * AddNewCommentOk transformer
 */
class AddNewCommentOk extends OkTransformer
{
    /**
     * @param mixed $data
     * @return mixed
     */
    protected function transform(mixed $data): mixed
    {
        return parent::transform([
            ['article' => $data[0]],
            $data[1]
        ]);
    }
}
