<?php

namespace App\Http\Controllers\Api\Auth\Requests;

use App\Models\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Leave request
 */
class Leave extends Request
{
    protected function getValidationRules(): array
    {
        return [
            'id' => 'required|integer|',
            'user.id' => 'required|integer|in:' . Auth::guard('api')->id(),
        ];
    }

    protected function getValidationMessages(): array
    {
        return [
            'id.required' => '학생 아이디를 입력하여 주십시오.',
            'id.integer' => '학생 아이디 입력값이 비정상적입니다.',
            'user.id.required' => '사용자 아이디를 입력하여 주십시오.',
            'user.id.integer' => '사용자 아이디 입력값이 비정상적입니다.',
            'user.id.in' => '권한이 없습니다.',
        ];
    }

    protected function getData(): array
    {
        return $this->json()->all();
    }
}
