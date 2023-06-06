<?php

namespace App\Models\Dto;

/**
 * Dto class
 */
abstract class Dto implements \JsonSerializable
{
    abstract public function __clone(): void;
}
