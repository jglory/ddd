<?php

namespace App\Modules\Database\MySql;

use App\Models\Repository\Inserter as InserterBase;
use App\Models\Repository\Updater as UpdaterBase;
use App\Modules\Database\Factory as Base;

class Factory extends Base
{
    public function inserters(string $class): InserterBase
    {
        return new Inserter();
    }

    public function updaters(string $class): UpdaterBase
    {
        return new Updater();
    }
}
