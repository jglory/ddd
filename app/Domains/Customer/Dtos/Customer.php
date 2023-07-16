<?php

namespace App\Domains\Customer\Dtos;

use App\Domains\User\Dtos\User as UserDto;
use App\Models\Dto\Entity as Dto;

/**
 * Auth class
 */
class Customer extends Dto
{
    public ?UserDto $user = null;

    public function jsonSerialize(): array
    {
        return parent::jsonSerialize()
            + ['user' => $this->user ? $this->user->jsonSerialize() : []];
    }

    public function __clone(): void
    {
        parent::__clone();
        if ($this->user) {
            $this->user = clone $this->user;
        }
    }
}
