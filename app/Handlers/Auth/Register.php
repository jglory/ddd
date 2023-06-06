<?php

namespace App\Handlers\Auth;

use App\Commands\Command;
use App\Domains\Student\Aggregates\Student as StudentAggregate;
use App\Domains\Student\Dtos\Student as StudentDto;
use App\Handlers\Handler;
use App\Models\Repository\Repository;
use App\Values\Http\Token;

/**
 * Register handler
 */
class Register extends Handler
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
        $dto = (new StudentAggregate($command->student))->toDto();
        $this->repository->save($dto);

        return $dto;
    }
}
