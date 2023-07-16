<?php

namespace App\Domains\User\Dtos;

use App\Models\Dto\Dto;
use App\Values\EmailAddress;
use App\Values\Password;

/**
 * CreateUser class
 *
 * @property EmailAddress|null $email
 * @property string|null $password
 *
 */
class LoginUser extends Dto
{
    public ?EmailAddress $email = null;
    public ?Password $password = null;

    public function __clone(): void
    {
        if ($this->email) {
            $this->email = clone $this->email;
        }
    }

    public function jsonSerialize(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
