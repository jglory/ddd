<?php

namespace App\Domains\Customer\Aggregates;

use App\Domains\Customer\Dtos\CreateCustomer as CreateCustomerDto;
use App\Domains\Customer\Dtos\Customer as CustomerDto;
use App\Domains\Customer\Exceptions\AlreadyLeaved as AlreadyLeavedException;
use App\Domains\User\Entities\User as UserEntity;
use App\Models\Aggregate\Aggregate;
use App\Models\Dto\Dto;
use Illuminate\Support\Carbon;

/**
 * Auth aggregate
 */
class Customer extends Aggregate
{
    private UserEntity $user;

    protected function isDtoConstructable(Dto $dto): bool
    {
        return $dto instanceof CreateCustomerDto || $dto instanceof CustomerDto;
    }

    protected function initialize(Dto $dto): void
    {
        $this->user = new UserEntity($dto->user);
    }

    public function toDto(): Dto
    {
        $dto = new CustomerDto();
        $dto->id = $this->id;
        $dto->createdAt = $this->createdAt;
        $dto->updatedAt = $this->updatedAt;
        $dto->deletedAt = $this->deletedAt;
        $dto->user = $this->user->toDto();

        return $dto;
    }

    public function leave()
    {
        if ($this->deletedAt) {
            throw new AlreadyLeavedException();
        }

        $this->user->leave();
        $this->deletedAt = Carbon::now();
    }
}
