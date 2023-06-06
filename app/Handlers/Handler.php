<?php

namespace App\Handlers;

use App\Commands\Command;

abstract class Handler
{
    abstract public function process(Command $command): mixed;
}
