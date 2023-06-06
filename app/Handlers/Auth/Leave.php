<?php

namespace App\Handlers\Auth;

use App\Commands\Command;
use App\Domains\Student\Aggregates\Student as StudentAggregate;
use App\Domains\Student\Dtos\Student as StudentDto;
use App\Domains\Student\Repositories\Repository;
use App\Domains\Student\Repositories\Specifications\FindById as FindByIdSpecification;
use App\Handlers\Auth\Exceptions\StudentNotFound;
use App\Handlers\Auth\Exceptions\StudentNotFound as StudentNotFoundException;
use App\Handlers\Handler;
use App\Values\Http\Token;

/**
 * Leave handler
 */
class Leave extends Handler
{
    private Repository $repository;

    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Command $command
     *
     * @return Token|null
     */
    public function process(Command $command): ?StudentDto
    {
        $dto = $this->repository->findOne(new FindByIdSpecification($command->student->id));
        if (is_null($dto)) {
            throw new StudentNotFoundException();
        }

        $student = new StudentAggregate($dto);
        $student->leave();

        $this->repository->save($dto = $student->toDto());
        return $dto;
    }
}
