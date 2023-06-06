<?php

namespace App\Commands\Auth;

use App\Commands\Command;
use App\Domains\Student\Dtos\LoginStudent as LoginStudentDto;

/**
 * Login command
 */
class Login extends Command
{
    public readonly LoginStudentDto $student;

    /**
     * @param LoginStudentDto $student
     */
    public function __construct(LoginStudentDto $student)
    {
        $this->student = $student;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'student' => $this->student->jsonSerialize(),
        ];
    }
}
