<?php

namespace App\Domains\Student\Dtos;

use App\Domains\User\Dtos\LoginUser as LoginUserDto;
use App\Models\Dto\Entity as Dto;

/**
 * LoginStudent class
 */
class LoginStudent extends Dto
{
    public ?LoginUserDto $user = null;

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
