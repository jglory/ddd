<?php

namespace App\Domains\Student\Dtos;

use App\Domains\User\Dtos\CreateUser as CreateUserDto;
use App\Models\Dto\Entity as Dto;

/**
 * CreateStudent class
 */
class CreateStudent extends Dto
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
