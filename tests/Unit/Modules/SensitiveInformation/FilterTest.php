<?php

namespace Tests\Unit\Modules\SensitiveInformation;

use App\Domains\Customer\Dtos\Customer as CustomerDto;
use App\Domains\User\Dtos\User as UserDto;
use App\Modules\Filter\SensitiveInformation\Filter;
use App\Values\EmailAddress;
use App\Values\Password;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

class FilterTest extends TestCase
{
    public function test_can_filter_1()
    {
        $faker = fake();

        $dto = dto(
            UserDto::class,
            [
                'id' => guid(),
                'name' => $faker->name(),
                'email' => new EmailAddress($faker->unique()->safeEmail()),
                'emailVerifiedAt' => Carbon::now(),
                'password' => new Password(bcrypt(env('TEST_USER_PASSWORD')), true),
                'rememberToken' => Str::random(10),
                'createdAt' => Carbon::now(),
            ]
        );

        $result = app('filter.sensitive-information')->process($dto);

        $this->assertFalse($dto === $result);
        $this->assertNull($result->password);
        $this->assertNull($result->rememberToken);
    }

    public function test_can_filter_2()
    {
        $faker = fake();

        $dto = dto(
            CustomerDto::class,
            [
                'id' => guid(),
                'createdAt' => Carbon::now(),
                'user' => dto(
                    UserDto::class,
                    [
                        'id' => guid(),
                        'name' => $faker->name(),
                        'email' => new EmailAddress($faker->unique()->safeEmail()),
                        'emailVerifiedAt' => Carbon::now(),
                        'password' => new Password(bcrypt(env('TEST_USER_PASSWORD')), true),
                        'rememberToken' => Str::random(10),
                        'createdAt' => Carbon::now(),
                    ]
                )
            ]
        );

        $result = app('filter.sensitive-information')->process($dto);

        $this->assertFalse($dto === $result);
        $this->assertNull($result->user->password);
        $this->assertNull($result->user->rememberToken);
    }
}
