<?php

namespace App\Http\Controllers\Api\Bbs\Requests;

use App\Models\Http\Request;

/**
 * GetArticleList request
 */
class GetArticleList extends Request
{
    /**
     * @return string[]
     */
    protected function getValidationRules(): array
    {
        return [
            'page' => 'required|integer',
            'pageSize' => 'required|integer'
        ];
    }

    /**
     * @return string[]
     */
    protected function getValidationMessages(): array
    {
        return [
            'page.required' => '페이지를 입력하여 주십시오.',
            'page.integer' => '페이지 입력값이 비정상적입니다.',
            'pageSize.required' => '페이지 사이즈를 입력하여 주십시오.',
            'pageSize.integer' => '페이지 사이즈 입력값이 비정상적입니다.',
        ];
    }

    /**
     * @return array
     */
    protected function getData(): array
    {
        return [
            'page' => $this->query('page'),
            'pageSize' => $this->query('pageSize'),
        ];
    }
}
