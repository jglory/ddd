<?php

namespace App\Commands\Auth;

use App\Commands\Command;

/**
 * Refresh command
 */
class Refresh extends Command
{
    /**
     * @param
     */
    public function __construct()
    {
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
