<?php

namespace App\Http\Controllers\Api\Bbs\Requests;

use App\Models\Http\Request;
use Illuminate\Validation\Rule;

/**
 * AddNewArticle request
 */
class AddNewArticle extends Request
{
    protected function getValidationRules(): array
    {
        return [
            'article.title' => 'required|string|max:500',
            'article.content' => 'nullable|string',
        ];
    }

    protected function getValidationMessages(): array
    {
        return [
            'article.title.required' => '제목을 입력하여 주십시오.',
            'article.title.string' => '제목 입력값이 비정상적입니다.',
            'article.title.max' => '제목 입력값은 최대 500자입니다.',
//            'article.content.required' => '내용을 입력하여 주십시오.',
            'article.content.string' => '내용 입력값이 비정상적입니다.',
        ];
    }

    protected function getData(): array
    {
        $article = $this->json()->get('article');
        return [
            'article' => [
                'title' => $article['title'] ?? null,
                'content' => $article['content'] ?? null,
            ]
        ];
    }
}
