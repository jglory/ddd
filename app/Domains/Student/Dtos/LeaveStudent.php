<?php

namespace App\Domains\Student\Dtos;

use App\Domains\User\Dtos\LeaveUser as LeaveUserDto;
use App\Models\Dto\Entity as Dto;

/**
 * LeaveStudent class
 */
class LeaveStudent extends Dto
{
    public LeaveUserDto $user;

    public function jsonSerialize(): mixed
    {
        return parent::jsonSerialize() + ['user' => $this->user->jsonSerialize()];
    }

    public function __clone(): void
    {
        parent::__clone();
        $this->user = clone $this->user;
    }
}
