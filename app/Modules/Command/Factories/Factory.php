<?php

namespace App\Modules\Command\Factories;

use App\Commands\Command;
use App\Models\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * Factory class
 */
class Factory
{
    /**
     * 적절한 Command 객체를 생성하여 돌려준다.
     *
     * @param Request $request
     *
     * @return Command
     */
    public function create(Request $request): Command
    {
        return App::make(
            'App\\Modules\\Command\\Factories\\' . str_replace('App\\Http\\Controllers\\Api\\', '', get_class($request))
        )->create($request);
    }
}
