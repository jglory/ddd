<?php

namespace App\Domains\Student\Aggregates;

use App\Domains\Student\Dtos\CreateStudent as CreateStudentDto;
use App\Domains\Student\Dtos\Student as StudentDto;
use App\Domains\Student\Exceptions\AlreadyLeaved as AlreadyLeavedException;
use App\Domains\User\Entities\User as UserEntity;
use App\Models\Aggregate\Aggregate;
use App\Models\Dto\Dto;
use Illuminate\Support\Carbon;

/**
 * Auth aggregate
 */
class Student extends Aggregate
{
    private UserEntity $user;

    protected function isDtoConstructable(Dto $dto): bool
    {
        return $dto instanceof CreateStudentDto || $dto instanceof StudentDto;
    }

    protected function initialize(Dto $dto): void
    {
        $this->user = new UserEntity($dto->user);
    }

    public function toDto(): Dto
    {
        $dto = new StudentDto();
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
