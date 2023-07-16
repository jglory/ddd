<?php

namespace App\Modules\Command\Factories\Auth\Requests;

use App\Commands\Auth\Refresh as AuthRefreshCommand;
use App\Commands\Command;
use App\Models\Http\Request;
use App\Modules\Command\Factories\Factory;

/**
 * Refresh factory
 */
class Refresh extends Factory
{
    public function create(Request $request): Command
    {
        return new AuthRefreshCommand();
    }
}
