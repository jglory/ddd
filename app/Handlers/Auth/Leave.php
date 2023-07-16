<?php

namespace App\Handlers\Auth;

use App\Commands\Command;
use App\Domains\Customer\Aggregates\Customer as CustomerAggregate;
use App\Domains\Customer\Dtos\Customer as CustomerDto;
use App\Domains\Customer\Repositories\Repository;
use App\Domains\Customer\Repositories\Specifications\FindById as FindByIdSpecification;
use App\Handlers\Auth\Exceptions\CustomerNotFound;
use App\Handlers\Auth\Exceptions\CustomerNotFound as CustomerNotFoundException;
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
    public function process(Command $command): ?CustomerDto
    {
        $dto = $this->repository->findOne(new FindByIdSpecification($command->customer->id));
        if (is_null($dto)) {
            throw new CustomerNotFoundException();
        }

        $customer = new CustomerAggregate($dto);
        $customer->leave();

        $this->repository->save($dto = $customer->toDto());
        return $dto;
    }
}
