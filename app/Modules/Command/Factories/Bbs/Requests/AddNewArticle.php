<?php

namespace App\Modules\Command\Factories\Bbs\Requests;

use App\Commands\Bbs\AddNewArticle as BbsAddNewArticleCommand;
use App\Commands\Command;
use App\Domains\Article\Dtos\AddNewArticle as AddNewArticleDto;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * AddNewArticle factory
 */
class AddNewArticle extends Factory
{
    /**
     * @param Request $request
     * @return Command
     */
    public function create(Request $request): Command
    {
        $article = $request->json()->get('article');
        return new BbsAddNewArticleCommand(
            dto(
                AddNewArticleDto::class,
                [
                    'writerId' => Auth::guard('api')->user()->getAuthIdentifier(),
                    'title' => $article['title'],
                    'content' => $article['content'],
                ]
            )
        );
    }
}
