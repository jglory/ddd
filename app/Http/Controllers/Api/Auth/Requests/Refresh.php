<?php

namespace App\Http\Controllers\Api\Auth\Requests;

use App\Models\Http\Request;

/**
 * Login request
 */
class Refresh extends Request
{
    protected function getValidationRules(): array
    {
        return [];
    }

    protected function getValidationMessages(): array
    {
        return [];
    }

    protected function getData(): array
    {
        return [];
    }
}
