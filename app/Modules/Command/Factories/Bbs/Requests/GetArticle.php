<?php

namespace App\Modules\Command\Factories\Bbs\Requests;

use App\Commands\Bbs\GetArticle as BbsGetArticleCommand;
use App\Commands\Command;
use App\Domains\Article\Dtos\GetArticle as GetArticleDto;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;

/**
 * GetArticle factory
 */
class GetArticle extends Factory
{
    /**
     * @param Request $request
     * @return Command
     */
    public function create(Request $request): Command
    {
        return new BbsGetArticleCommand(
            dto(
                GetArticleDto::class,
                [
                    'id' => $request->route()->parameter('articleId'),
                ]
            )
        );
    }
}
