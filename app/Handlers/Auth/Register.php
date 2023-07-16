<?php

namespace App\Handlers\Auth;

use App\Commands\Command;
use App\Domains\Customer\Aggregates\Customer as CustomerAggregate;
use App\Domains\Customer\Dtos\Customer as CustomerDto;
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
    public function process(Command $command): ?CustomerDto
    {
        $dto = (new CustomerAggregate($command->customer))->toDto();
        $this->repository->save($dto);

        return $dto;
    }
}
