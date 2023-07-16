<?php

namespace Tests\Unit\Domains;

use App\Domains\Student\Aggregates\Customer as StudentAggregate;
use App\Domains\Student\Dtos\CreateCustomer as CreateStudentDto;
use App\Domains\Student\Repositories\Repository as StudentRepository;
use App\Domains\Student\Repositories\Specifications\FindById;
use App\Domains\User\Dtos\CreateUser as CreateUserDto;
use App\Values\EmailAddress;
use Faker\Factory as Faker;
use Faker\Generator as Generator;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class StudentTest extends TestCase
{
    private Generator $generator;
    private StudentRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = Faker::create('ko_KR');
        $this->repository = App::make(StudentRepository::class);
    }

    /**
     * @test
     * A basic test example.
     *
     * @return void
     */
    public function 학생생성_테스트()
    {
        $userDto = new CreateUserDto();
        $userDto->name = $this->generator->name;
        $userDto->email = new EmailAddress($this->generator->email);
        $userDto->password = bcrypt('thomas123!');

        $studentDto = new CreateStudentDto();
        $studentDto->user = $userDto;

        $student = new StudentAggregate($studentDto);
        $dto = $student->toDto();
        $this->assertNotEmpty($student);

        $this->repository->save($dto);

        var_dump($student);
    }

    /**
     * @test
     * A basic test example.
     *
     * @return void
     */
    public function 학생조회_테스트()
    {
        $dto = $this->repository->findOne(new FindById(2));
        $this->assertNotEmpty($dto);
    }
}
