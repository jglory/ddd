<?php

namespace Tests\Unit\Domains\User\Repository;

use App\Domains\User\Dtos\User as UserDto;
use App\Domains\User\Repositories\Repository as UserRepository;
use App\Domains\User\Repositories\Specifications\FindById as FindByIdSpecification;
use App\Values\EmailAddress;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $repo = App::make(UserRepository::class);
        $user = new UserDto();
        $user->id = 1;
        $user->name = 'thomas';
        $user->email = new EmailAddress('thomas@tutoring.co.kr');
        $user->password = bcrypt('thomas123!');
        $repo->save($user);

        $result = $repo->findOne(new FindByIdSpecification(1));
        $this->assertTrue(empty($result) === false);

        $cloned = clone($result);
        $cloned->email = new EmailAddress('yongmoon@hanmail.net');
        $repo->save($cloned);
        $result = $repo->findOne(new FindByIdSpecification(1));
        $this->assertTrue(empty($result) === false);
        $this->assertTrue($result->email=='yongmoon@hanmail.net');
    }
}
