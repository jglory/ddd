<?php

namespace App\Http\Controllers\Api\Auth\Requests;

use App\Models\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Login request
 */
class Register extends Request
{
    protected function getValidationRules(): array
    {
        return [
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email:rfc|max:255',
            'user.password.value' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'user.password.isEncrypted' => [
                'required',
                'boolean',
                Rule::in([false]),
            ],
        ];
    }

    protected function getValidationMessages(): array
    {
        return [
            'user.name.required' => '이름을 입력하여 주십시오.',
            'user.name.string' => '이름 입력값이 비정상적입니다.',
            'user.name.max' => '이름 입력값은 최대 255자입니다.',
            'user.email.required' => '이메일을 입력하여 주십시오.',
            'user.email.email' => '이메일 입력값이 비정상적입니다.',
            'user.email.max' => '이메일 입력값은 @문자를 포함 최대 255자입니다.',
            'user.password.value.required' => '암호를 입력하여 주십시오.',
            'user.password.value.min' => '암호 최소 입력값은 8자입니다.',
            'user.password.value.string' => '암호 입력값이 비정상적입니다.',
            'user.password.value.regex' => '암호는 최소 1글자 이상의 영문 대문자, 영문 소문자, 숫자, 특수문자(@$!%*#?&)를 포함하여야 합니다.',
            'user.password.isEncrypted.required' => '암호 입력값이 비정상적입니다.',
            'user.password.isEncrypted.boolean' => '암호 입력값이 비정상적입니다.',
            'user.password.isEncrypted.in' => '암호 입력값이 비정상적입니다.',
        ];
    }

    protected function getData(): array
    {
        return [
            'user' => $this->json()->all()['user'],
        ];
    }
}
