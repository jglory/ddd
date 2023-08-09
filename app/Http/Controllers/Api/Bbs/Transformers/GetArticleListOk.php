<?php

namespace App\Http\Controllers\Api\Bbs\Transformers;

use App\Http\Transformers\Ok as OkTransformer;

/**
 * GetArticleListOk transformer
 */
class GetArticleListOk extends OkTransformer
{
    /**
     * @param mixed $data
     * @return mixed
     */
    protected function transform(mixed $data): mixed
    {
        return parent::transform([
            ['list' => $data[0]],
            $data[1]
        ]);
    }
}
