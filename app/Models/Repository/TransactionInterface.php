<?php

namespace App\Models\Repository;

/**
 * TransactionInterface interface
 */
interface TransactionInterface
{
    public function start();
    public function commit();
    public function rollback();
}
