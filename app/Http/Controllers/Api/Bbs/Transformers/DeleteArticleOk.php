<?php

namespace App\Http\Controllers\Api\Bbs\Transformers;

use App\Http\Transformers\Ok as OkTransformer;

/**
 * DeleteArticleSuccess transformer
 */
class DeleteArticleOk extends OkTransformer
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
