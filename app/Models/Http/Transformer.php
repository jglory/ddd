<?php

namespace App\Models\Http;

use App\Modules\Transformer\Transformer as Base;

/**
 * 트랜스포머 베이스 클래스
 * Class Transformer
 * @package App\Models\Http
 */
abstract class Transformer extends Base
{
    /**
     * 민감정보 필터링 객체
     *
     * @var Base
     */
    protected Base $filter;

    /**
     * $data에 대해 의도된 변환을 수행하여 돌려준다.
     *
     * @param mixed $data
     * @return mixed
     */
    protected function transform(mixed $data): mixed
    {
        return $data;
    }

    /**
     * 생성자
     */
    public function __construct()
    {
        $this->filter = app('filter.sensitive-information');
    }

    /**
     * $data에 대해 의도된 변환을 수행하여 돌려준다.
     *
     * @param mixed $data
     * @return mixed
     */
    final public function process(mixed $data): mixed
    {
        return $this->transform($this->filter->process($data));
    }
}
