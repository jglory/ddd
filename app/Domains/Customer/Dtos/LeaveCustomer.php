<?php

namespace App\Domains\Customer\Dtos;

use App\Domains\User\Dtos\LeaveUser as LeaveUserDto;
use App\Models\Dto\Entity as Dto;

/**
 * LeaveCustomer class
 */
class LeaveCustomer extends Dto
{
    public LeaveUserDto $user;

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + ['user' => $this->user->jsonSerialize()];
    }

    public function __clone(): void
    {
        parent::__clone();
        $this->user = clone $this->user;
    }
}
