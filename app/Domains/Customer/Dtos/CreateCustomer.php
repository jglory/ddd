<?php

namespace App\Domains\Customer\Dtos;

use App\Domains\User\Dtos\CreateUser as CreateUserDto;
use App\Models\Dto\Entity as Dto;

/**
 * CreateCustomer class
 */
class CreateCustomer extends Dto
{
    public ?CreateUserDto $user = null;

    public function jsonSerialize(): mixed
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
