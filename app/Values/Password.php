<?php

namespace App\Values;

use Stringable;

/**
 * Password value
 */
class Password extends Value implements Stringable
{
    public readonly string $value;
    public readonly bool $isEncrypted;

    /**
     * @param string $value
     * @param bool $isEncrypted
     */
    public function __construct(string $value, bool $isEncrypted)
    {
        $this->value = $value;
        $this->isEncrypted = $isEncrypted;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        return [
            'value' => $this->value,
            'isEncrypted' => $this->isEncrypted,
        ];
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
