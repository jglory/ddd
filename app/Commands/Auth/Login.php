<?php

namespace App\Commands\Auth;

use App\Commands\Command;
use App\Domains\Customer\Dtos\LoginCustomer as LoginCustomerDto;

/**
 * Login command
 */
class Login extends Command
{
    public readonly LoginCustomerDto $customer;

    /**
     * @param LoginCustomerDto $customer
     */
    public function __construct(LoginCustomerDto $customer)
    {
        $this->customer = $customer;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'customer' => $this->customer->jsonSerialize(),
        ];
    }
}
