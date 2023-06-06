<?php

namespace App\Handlers\Auth;

use App\Commands\Command;
use App\Handlers\Handler;
use App\Values\Http\Token;
use App\Values\Http\TokenType;
use Illuminate\Support\Facades\Auth;

/**
 * Login handler
 */
class Login extends Handler
{
    /**
     * @param Command $command
     *
     * @return Token|null
     */
    public function process(Command $command): ?Token
    {
        if (!$token = Auth::guard('api')->attempt(['email' => $command->student->user->email, 'password' => $command->student->user->password])) {
            return null;
        }

        return new Token($token, new TokenType(TokenType::BEARER), Auth::guard('api')->factory()->getTTL() * 60);
    }
}
