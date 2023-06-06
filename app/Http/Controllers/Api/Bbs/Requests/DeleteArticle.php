<?php

namespace App\Http\Controllers\Api\Bbs\Requests;

use App\Models\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * DeleteArticle request
 */
class DeleteArticle extends Request
{
    protected function getValidationRules(): array
    {
        return [
            'article.id' => 'required|integer|',
        ];
    }

    protected function getValidationMessages(): array
    {
        return [
            'article.id.required' => '게시물 아이디를 입력하여 주십시오.',
            'article.id.integer' => '게시물 아이디 입력값이 비정상적입니다.',
        ];
    }

    protected function getData(): array
    {
        $article = $this->json()->get('article');
        return [
            'article' => [
                'id' => $article['id'] ?? null,
            ]
        ];
    }
}
