<?php

namespace App\Commands\Auth;

use App\Commands\Command;
use App\Domains\Student\Dtos\CreateStudent as CreateStudentDto;

/**
 * Login command
 */
class Register extends Command
{
    public readonly CreateStudentDto $student;

    /**
     * @param CreateStudentDto $student
     */
    public function __construct(CreateStudentDto $student)
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
