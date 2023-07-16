<?php

namespace App\Modules\Command\Factories\Bbs\Requests;

use App\Commands\Bbs\DeleteArticle as BbsDeleteArticleCommand;
use App\Commands\Command;
use App\Domains\Article\Dtos\DeleteArticle as DeleteArticleDto;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * DeleteArticle factory
 */
class DeleteArticle extends Factory
{
    /**
     * @param Request $request
     * @return Command
     */
    public function create(Request $request): Command
    {
        $article = $request->json()->get('article');
        return new BbsDeleteArticleCommand(
            Auth::guard('api')->user()->getAuthIdentifier(),
            dto(
                DeleteArticleDto::class,
                [
                    'id' => $article['id'],
                ]
            )
        );
    }
}
