<?php

namespace App\Modules\Command\Factories\Auth\Requests;

use App\Commands\Auth\Register as AuthRegisterCommand;
use App\Commands\Command;
use App\Domains\Customer\Dtos\CreateCustomer as CreateCustomerDto;
use App\Domains\User\Dtos\CreateUser as CreateUserDto;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;
use App\Values\EmailAddress;
use App\Values\Password;

/**
 * Login factory
 */
class Register extends Factory
{
    public function create(Request $request): Command
    {
        $json = $request->json()->all()['user'];

        return new AuthRegisterCommand(
            dto(
                CreateCustomerDto::class,
                [
                    'user' => dto(
                        CreateUserDto::class,
                        [
                            'name' => $json['name'],
                            'email' => new EmailAddress($json['email']),
                            'password' => new Password($json['password']['value'], $json['password']['isEncrypted']),
                        ]
                    ),
                ]
            )
        );
    }
}
