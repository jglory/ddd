<?php

namespace App\Http\Controllers\Api\Bbs\Requests;

use App\Models\Http\Request;

/**
 * DeleteComment request
 */
class DeleteComment extends Request
{
    protected function getValidationRules(): array
    {
        return [
            'articleId' => 'required|integer',
            'commentId' => 'required|integer|',
        ];
    }

    protected function getValidationMessages(): array
    {
        return [
            'articleId.required' => '게시물 아이디를 입력하여 주십시오.',
            'articleId.integer' => '게시물 아이디 입력값이 비정상적입니다.',
            'commentId.required' => '댓글 아이디를 입력하여 주십시오.',
            'commentId.integer' => '댓글 아이디 입력값이 비정상적입니다.',
        ];
    }

    protected function getData(): array
    {
        return [
            'articleId' => $this->route()->parameter('articleId'),
            'commentId' => $this->route()->parameter('commentId'),
        ];
    }
}
