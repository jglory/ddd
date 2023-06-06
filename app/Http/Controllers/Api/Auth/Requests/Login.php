<?php

namespace App\Http\Controllers\Api\Auth\Requests;

use App\Models\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Login request
 */
class Login extends Request
{
    protected function getValidationRules(): array
    {
        return [
            'user.email' => 'required|email:rfc,dns|max:255',
            'user.password.value' => 'required|string|min:8',
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
            'user.email.required' => '이메일을 입력하여 주십시오.',
            'user.email.email' => '이메일 입력값이 비정상적입니다.',
            'user.email.max' => '이메일 입력값은 @문자를 포함 최대 255자입니다.',
            'user.password.value.required' => '암호를 입력하여 주십시오.',
            'user.password.value.min' => '암호 최소 입력값은 8자입니다.',
            'user.password.value.string' => '암호 입력값이 비정상적입니다.',
            'user.password.isEncrypted.required' => '암호 입력값이 비정상적입니다.1',
            'user.password.isEncrypted.boolean' => '암호 입력값이 비정상적입니다.2',
            'user.password.isEncrypted.in' => '암호 입력값이 비정상적입니다.3',
        ];
    }

    protected function getData(): array
    {
        return $this->json()->all();
    }
}
