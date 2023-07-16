<?php

namespace App\Modules\Database\MySql;

use App\Models\Dto\Entity as Dto;
use App\Models\Repository\Inserter as Base;

class Inserter extends Base
{
    public function process(Dto $dto): void
    {
        $this->mapper->create($dto)->save();
    }
}

