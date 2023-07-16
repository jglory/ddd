<?php

namespace App\Modules\Command\Factories\Auth\Requests;

use App\Commands\Auth\Login as AuthLoginCommand;
use App\Commands\Command;
use App\Domains\Customer\Dtos\LoginCustomer as LoginCustomerDto;
use App\Domains\User\Dtos\LoginUser as LoginUserDto;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;
use App\Values\EmailAddress;
use App\Values\Password;

/**
 * Login factory
 */
class Login extends Factory
{
    public function create(Request $request): Command
    {
        $json = $request->json()->all()['user'];

        return new AuthLoginCommand(
            dto(
                LoginCustomerDto::class,
                [
                    'user' => dto(
                        LoginUserDto::class,
                        [
                            'email' => new EmailAddress($json['email']),
                            'password' => new Password($json['password']['value'], $json['password']['isEncrypted'])
                        ]
                    ),
                ]
            )
        );
    }
}
