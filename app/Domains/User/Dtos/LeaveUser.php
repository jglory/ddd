<?php

namespace App\Domains\User\Dtos;

use App\Models\Dto\Dto;

/**
 * LeaveUser class
 *
 * @property int|null $id
 *
 */
class LeaveUser extends Dto
{
    public ?int $id = null;

    public function __clone(): void
    {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
        ];
    }
}
