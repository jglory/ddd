<?php

namespace App\Modules\Command\Factories\Bbs\Requests;

use App\Commands\Bbs\AddNewComment as BbsAddNewCommentCommand;
use App\Commands\Command;
use App\Domains\Comment\Dtos\AddNewComment as AddNewCommentDto;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * AddNewComment factory
 */
class AddNewComment extends Factory
{
    /**
     * @param Request $request
     * @return Command
     */
    public function create(Request $request): Command
    {
        $comment = $request->json()->get('comment');
        return new BbsAddNewCommentCommand(
            dto(
                AddNewCommentDto::class,
                [
                    'articleId' => $comment['articleId'],
                    'comment' => $comment['comment'],
                ]
            )
        );
    }
}
