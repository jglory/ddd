<?php

namespace App\Modules\Database;

use App\Models\Repository\Inserter;
use App\Models\Repository\Updater;

abstract class Factory
{
    abstract public function inserters(string $class): Inserter;
    abstract public function updaters(string $class): Updater;
}
