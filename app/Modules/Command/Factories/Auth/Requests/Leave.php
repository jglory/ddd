<?php

namespace App\Modules\Command\Factories\Auth\Requests;

use App\Commands\Auth\Leave as AuthLeaveCommand;
use App\Commands\Command;
use App\Domains\Customer\Dtos\LeaveCustomer as LeaveCustomerDto;
use App\Domains\User\Dtos\LeaveUser as LeaveUserDto;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;

/**
 * Leave factory
 */
class Leave extends Factory
{
    public function create(Request $request): Command
    {
        $json = $request->json()->all();

        return new AuthLeaveCommand(
            dto(
                LeaveCustomerDto::class,
                [
                    'id' => $json['id'],
                    'user' => dto(
                        LeaveUserDto::class,
                        [
                            'id' => $json['user']['id'],
                        ]
                    ),
                ]
            )
        );
    }
}
