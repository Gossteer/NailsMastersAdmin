<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Logger\iLoggerConfig;
use App\Services\Logger\LoggerConfig;

class LoggerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(iLoggerConfig::class, function ($app) {
            return new LoggerConfig(config('logger.type_id'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
