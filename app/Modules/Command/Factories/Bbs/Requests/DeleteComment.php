<?php

namespace App\Modules\Command\Factories\Bbs\Requests;

use App\Commands\Bbs\DeleteComment as BbsDeleteCommentCommand;
use App\Commands\Command;
use App\Domains\Comment\Dtos\DeleteComment as DeleteCommentDto;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * DeleteComment factory
 */
class DeleteComment extends Factory
{
    /**
     * @param Request $request
     * @return Command
     */
    public function create(Request $request): Command
    {
        return new BbsDeleteCommentCommand(
            Auth::guard('api')->user()->getAuthIdentifier(),
            dto(
                DeleteCommentDto::class,
                [
                    'id' => $request->route()->parameter('commentId'),
                    'articleId' => $request->route()->parameter('articleId'),
                ]
            )
        );
    }
}
