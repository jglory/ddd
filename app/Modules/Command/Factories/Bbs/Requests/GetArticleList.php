<?php

namespace App\Modules\Command\Factories\Bbs\Requests;

use App\Commands\Bbs\GetArticleList as BbsGetArticleListCommand;
use App\Commands\Command;
use App\Domains\Article\Dtos\GetArticle as GetArticleDto;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;

/**
 * GetArticleList factory
 */
class GetArticleList extends Factory
{
    /**
     * @param Request $request
     * @return Command
     */
    public function create(Request $request): Command
    {
        return new BbsGetArticleListCommand(
            $request->query('page'),
            $request->query('pageSize')
        );
    }
}
