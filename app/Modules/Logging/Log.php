<?php

namespace App\Modules\Logging;

class Log implements \Stringable, \JsonSerializable
{
    /** @var string */
    private string $method;
    /** @var array */
    private array $data;

    /**
     * @param string $method
     * @param array $data
     */
    public function __construct(string $method, array $data)
    {
        $this->method = $method;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function __toString(): string
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }

    public function jsonSerialize(): array
    {
        return [
            'method' => $this->method,
            'data' => $this->data,
        ];
    }
}
