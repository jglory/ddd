<?php

namespace App\Domains\User\Entities;

use App\Domains\User\Dtos\CreateUser as CreateUserDto;
use App\Domains\User\Dtos\User as UserDto;
use App\Domains\User\Exceptions\AlreadyLeaved;
use App\Models\Dto\Dto;
use App\Models\Entity\Entity;
use App\Values\EmailAddress;
use App\Values\Password;
use Illuminate\Support\Carbon;

class User extends Entity
{
    protected string $name;
    protected EmailAddress $email;
    protected ?Carbon $emailVerifiedAt = null;
    protected Password $password;
    protected ?string $rememberToken = null;

    /**
     * @param Dto $dto
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(Dto $dto)
    {
        parent::__construct($dto);
        if ($this->password->isEncrypted === false) {
            $this->password = new Password(bcrypt($this->password->value), true);
        }
    }

    protected function createDto(): Dto
    {
        return new UserDto();
    }

    protected function isDtoConstructable(Dto $dto): bool
    {
        return $dto instanceof CreateUserDto || $dto instanceof UserDto;
    }

    public function leave()
    {
        if ($this->deletedAt) {
            throw new AlreadyLeaved();
        }
        $this->deletedAt = Carbon::now();
    }
}
