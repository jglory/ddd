<?php

namespace App\Handlers\Auth;

use App\Commands\Command;
use App\Handlers\Handler;
use App\Values\Http\Token;
use App\Values\Http\TokenType;
use Illuminate\Support\Facades\Auth;

/**
 * Refresh handler
 */
class Refresh extends Handler
{
    /**
     * @param Command $command
     *
     * @return array
     */
    public function process(Command $command): ?Token
    {
        return new Token(
            Auth::guard('api')->refresh(),
            new TokenType(TokenType::BEARER),
            Auth::guard('api')->factory()->getTTL() * 60
        );
    }
}
