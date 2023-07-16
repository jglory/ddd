<?php

namespace App\Http\Controllers\Api\Bbs\Requests;

use App\Models\Http\Request;

/**
 * AddNewComment request
 */
class AddNewComment extends Request
{
    protected function getValidationRules(): array
    {
        return [
            'comment.articleId' => 'required|integer',
            'comment.comment' => 'nullable|string|max:1000',
        ];
    }

    protected function getValidationMessages(): array
    {
        return [
            'comment.articleId.required' => '게시물 아이디를 입력하여 주십시오.',
            'comment.articleId.integer' => '게시물 아이디 입력값이 비정상적입니다.',
            'comment.comment.required' => '댓글을 입력하여 주십시오.',
            'comment.comment.string' => '댓글 입력값이 비정상적입니다.',
            'comment.comment.max' => '댓글 입력값은 최대 1000자입니다.',
        ];
    }

    protected function getData(): array
    {
        $comment = $this->json()->get('comment');
        return [
            'comment' => [
                'articleId' => $comment['articleId'] ?? null,
                'comment' => $comment['comment'] ?? null,
            ]
        ];
    }
}
