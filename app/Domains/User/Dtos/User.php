<?php

namespace App\Domains\User\Dtos;

use App\Models\Dto\Entity as Dto;
use App\Values\EmailAddress;
use App\Values\Password;
use Illuminate\Support\Carbon;

/**
 * User class
 */
class User extends Dto
{
    public ?string $name = null;
    public ?EmailAddress $email = null;
    public ?Carbon $emailVerifiedAt = null;
    public ?Password $password = null;
    public ?string $rememberToken = null;

    public function jsonSerialize(): mixed
    {
        return parent::jsonSerialize() + [
                'name' => $this->name,
                'email' => $this->email,
                'emailVerifiedAt' => $this->emailVerifiedAt,
                'password' => $this->password,
                'rememberToken' => $this->rememberToken,
            ];
    }

    public function __clone(): void
    {
        parent::__clone();
        if ($this->emailVerifiedAt) {
            $this->emailVerifiedAt = clone $this->emailVerifiedAt;
        }
    }
}
