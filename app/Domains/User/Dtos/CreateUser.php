<?php

namespace App\Domains\User\Dtos;

use App\Models\Dto\Dto;
use App\Values\EmailAddress;
use App\Values\Password;

/**
 * CreateUser class
 *
 * @property string|null $name
 * @property EmailAddress|null $email
 * @property Password|null $password
 *
 */
class CreateUser extends Dto
{
    public ?string $name = null;
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
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
