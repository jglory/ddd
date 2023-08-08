<?php

namespace App\Modules\Transformer;

/**
 * 트랜스포머 베이스 클래스
 * Class Transformer
 * @package App\Modules\Transformer
 */
abstract class Transformer
{
    /**
     * @param mixed $data
     * @return mixed
     */
    abstract public function process(mixed $data): mixed;
}
