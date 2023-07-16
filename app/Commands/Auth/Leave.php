<?php

namespace App\Commands\Auth;

use App\Commands\Command;
use App\Domains\Customer\Dtos\LeaveCustomer as LeaveCustomerDto;

/**
 * Login command
 */
class Leave extends Command
{
    public readonly LeaveCustomerDto $customer;

    /**
     * @param LeaveCustomerDto $customer
     */
    public function __construct(LeaveCustomerDto $customer)
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
