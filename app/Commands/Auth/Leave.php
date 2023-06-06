<?php

namespace App\Commands\Auth;

use App\Commands\Command;
use App\Domains\Student\Dtos\LeaveStudent as LeaveStudentDto;

/**
 * Login command
 */
class Leave extends Command
{
    public readonly LeaveStudentDto $student;

    /**
     * @param LeaveStudentDto $student
     */
    public function __construct(LeaveStudentDto $student)
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
