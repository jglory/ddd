<?php

namespace App\Models\Http;

/**
 * 트랜스포머 베이스 클래스
 * Class Transformer
 * @package App\Models\Http
 */
abstract class Transformer
{
    /**
     * @param mixed $data
     * @return mixed
     */
    abstract public function process(mixed $data): mixed;
}
