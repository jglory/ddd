<?php

namespace App\Modules\Database\MySql;

use App\Models\Dto\Entity as Dto;
use App\Models\Repository\Updater as Base;
use Illuminate\Support\Facades\DB;

class Updater extends Base
{
    public function process(Dto $dto): void
    {
        $eloq = $this->mapper->create($dto);
        DB::table($eloq->getTable())
            ->where('id', $eloq->id)
            ->update($eloq->getAttributes());
    }
}
