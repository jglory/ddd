<?php

namespace App\Models\Repository;

use Illuminate\Support\Facades\DB;

/**
 * Transaction class
 */
class Transaction implements TransactionInterface
{
    /**
     * @return void
     */
    public function start()
    {
        DB::beginTransaction();
    }

    /**
     * @return void
     */
    public function commit()
    {
        DB::commit();
    }

    /**
     * @param int|null $toLevel
     * @return void
     */
    public function rollback(int $toLevel = null)
    {
        DB::rollBack($toLevel);
    }
}
