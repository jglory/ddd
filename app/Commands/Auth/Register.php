<?php

namespace App\Commands\Auth;

use App\Commands\Command;
use App\Domains\Customer\Dtos\CreateCustomer as CreateCustomerDto;

/**
 * Login command
 */
class Register extends Command
{
    public readonly CreateCustomerDto $customer;

    /**
     * @param CreateCustomerDto $customer
     */
    public function __construct(CreateCustomerDto $customer)
    {
        $this->customer = $customer;
    }

    public function jsonSerialize(): array
    {
        return [
            'customer' => $this->customer->jsonSerialize(),
        ];
    }
}
