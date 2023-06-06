<?php

namespace Tests\Unit\Modules\Mapper\RequestToCommand;

use App\Modules\Mapper\Mapper;
use App\Modules\Mapper\RequestToCommand\StudentLogin as StudentLoginMapper;
use Faker\Factory as Faker;
use Faker\Generator as Generator;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class Request
{
    private Generator $generator;

    /**
     * @param
     */
    public function __construct()
    {
        $this->generator = Faker::create('ko_KR');
    }

    public function json(string $name)
    {
        switch ($name) {
            case 'email':
                return $this->generator->email;
            case 'password':
                return 'thomas123!';
        }
    }
}

class StudentLoginTest extends TestCase
{
    private Mapper $mapper;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = App::make(StudentLoginMapper::class);
    }
    
    /**
     * @test
     * A basic test example.
     *
     * @return void
     */
    public function StudentLogin맵퍼_테스트()
    {
        $command = $this->mapper->create(new Request());
        $this->assertNotEmpty($command);
    }
}
