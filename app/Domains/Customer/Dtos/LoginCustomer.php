<?php

namespace App\Domains\Customer\Dtos;

use App\Domains\User\Dtos\LoginUser as LoginUserDto;
use App\Models\Dto\Entity as Dto;

/**
 * LoginCustomer class
 */
class LoginCustomer extends Dto
{
    public ?LoginUserDto $user = null;

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
