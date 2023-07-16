<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void start()
 * @method static void commit()
 * @method static void rollBack(int $toLevel = null)
 *
 * @see \App\Models\Repository\Transaction
 */
class Transaction extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'transaction';
    }
}
