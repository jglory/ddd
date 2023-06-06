<?php

namespace App\Providers;

use App\Modules\Logging\Log as LogItem;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        'transaction' => \App\Models\Repository\Transaction::class,
        'dto-to-eloquent' => \App\Modules\Mapper\DtoToEloquent::class,
        'eloquent-to-dto' => \App\Modules\Mapper\EloquentToDto::class,
        \App\Domains\Student\Repositories\Repository::class => \App\Domains\Student\Repositories\Repository::class,
        \App\Handlers\Auth\Login::class => \App\Handlers\Auth\Login::class,
        \App\Handlers\Auth\Refresh::class => \App\Handlers\Auth\Refresh::class,
        \App\Modules\Command\Factories\Auth\Requests\Login::class => \App\Modules\Command\Factories\Auth\Requests\Login::class,
        \App\Modules\Command\Factories\Auth\Requests\Refresh::class => \App\Modules\Command\Factories\Auth\Requests\Refresh::class,
        \App\Modules\Command\Factories\Factory::class => \App\Modules\Command\Factories\Factory::class,
        \App\Modules\Database\Factory::class => \App\Modules\Database\MySql\Factory::class,
        \App\Modules\Rns\HandlerRns::class => \App\Modules\Rns\HandlerRns::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(\App\Handlers\Auth\Register::class)
            ->needs(\App\Models\Repository\Repository::class)
            ->give(\App\Domains\Student\Repositories\Repository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('DB_LOG', false)) {
            DB::listen(function ($query) {
                $sql = $query->sql;

                foreach ($query->bindings as $binding) {
                    $value = is_null($binding)
                        ? 'null'
                        : (in_array(gettype($binding), ['string', 'object'])
                            ? "'" . $binding . "'" : $binding);
                    $sql = preg_replace('/\?/', $value, $sql, 1);
                }
                Log::debug(
                    new LogItem(__METHOD__, [
                        'time' => $query->time,
                        'sql' => $sql,
                    ])
                );
            });
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'transaction',
            'dto-to-eloquent',
            'eloquent-to-dto',
            //\App\Domains\Student\Repositories\Repository::class,
            \App\Handlers\Auth\Login::class,
            \App\Handlers\Auth\Refresh::class,
            \App\Handlers\Auth\Register::class,
            \App\Modules\Command\Factories\Auth\Requests\Login::class,
            \App\Modules\Command\Factories\Auth\Requests\Refresh::class,
            \App\Modules\Command\Factories\Factory::class,
            \App\Modules\Database\Factory::class,
            \App\Modules\Rns\HandlerRns::class,
        ];
    }
}
