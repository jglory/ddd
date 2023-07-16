<?php

namespace Tests\Unit\Domains\User;

use App\Domains\User\Dtos\CreateUser as CreateUserDto;
use App\Domains\User\Entities\User as UserEntity;
use App\Domains\User\Repositories\Repository as UserRepository;
use App\Values\EmailAddress;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class UserTest extends TestCase
{
    private UserRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = App::make(UserRepository::class);
    }

    /**
     * @test
     * A basic test example.
     *
     * @return void
     */
    public function 유저생성_테스트()
    {
        $dto = new CreateUserDto();
        $dto->name = 'thomas';
        $dto->email = new EmailAddress('thomas@tutoring.co.kr');
        $dto->password = bcrypt('thomas123!');
        $entity = new UserEntity($dto);
        $this->assertNotEmpty($entity);

        $this->repository->save($entity->toDto());
    }
}
