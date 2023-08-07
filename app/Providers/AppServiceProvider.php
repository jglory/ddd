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
        \App\Domains\Customer\Repositories\Repository::class => \App\Domains\Customer\Repositories\Repository::class,
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
        // Auth
        $this->app->when(\App\Handlers\Auth\Register::class)
            ->needs(\App\Models\Repository\Repository::class)
            ->give(\App\Domains\Customer\Repositories\Repository::class);

        // Bbs
        $this->app->when(\App\Handlers\Bbs\AddNewArticle::class)
            ->needs(\App\Models\Repository\Repository::class)
            ->give(\App\Domains\Article\Repositories\Repository::class);
        $this->app->when(\App\Handlers\Bbs\AddNewComment::class)
            ->needs(\App\Models\Repository\Repository::class)
            ->give(\App\Domains\Article\Repositories\Repository::class);
        $this->app->when(\App\Handlers\Bbs\GetArticle::class)
            ->needs(\App\Models\Repository\Repository::class)
            ->give(\App\Domains\Article\Repositories\Repository::class);
        $this->app->when(\App\Handlers\Bbs\GetArticleList::class)
            ->needs(\App\Models\Repository\Repository::class)
            ->give(\App\Domains\Article\Repositories\Repository::class);

        $this->app->bind(\App\Http\Controllers\Api\Auth\Requests\Login::class, function ($app) {
            return \App\Http\Controllers\Api\Auth\Requests\Login::createFrom($app->request);
        });
        $this->app->bind(\App\Http\Controllers\Api\Auth\Requests\Register::class, function ($app) {
            return \App\Http\Controllers\Api\Auth\Requests\Register::createFrom($app->request);
        });
        $this->app->bind(\App\Http\Controllers\Api\Bbs\Requests\DeleteComment::class, function ($app) {
            return \App\Http\Controllers\Api\Bbs\Requests\DeleteComment::createFrom($app->request);
        });
        $this->app->bind(\App\Http\Controllers\Api\Bbs\Requests\GetArticle::class, function ($app) {
            return \App\Http\Controllers\Api\Bbs\Requests\GetArticle::createFrom($app->request);
        });
        $this->app->bind(\App\Http\Controllers\Api\Bbs\Requests\GetArticleList::class, function ($app) {
            return \App\Http\Controllers\Api\Bbs\Requests\GetArticleList::createFrom($app->request);
        });
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
            //\App\Domains\Customer\Repositories\Repository::class,
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
