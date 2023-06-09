<?php

namespace App\Domains\Student\Dtos;

use App\Domains\User\Dtos\User as UserDto;
use App\Models\Dto\Entity as Dto;

/**
 * Auth class
 */
class Student extends Dto
{
    public ?UserDto $user = null;

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
