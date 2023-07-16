<?php

namespace App\Models\Entity;

use App\Models\Dto\Dto;

/**
 * ToDtoInterface interface
 */
interface ToDtoInterface
{
    /**
     * @return mixed
     */
    public function toDto(): Dto;
}
