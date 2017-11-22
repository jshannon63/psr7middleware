<?php

namespace Jshannon63\Psr7Middleware;

use Illuminate\Support\ServiceProvider;

class Psr7MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__.'/../config/Psr7Middleware.php');
        $destination = app_path('Http/Middleware/Psr7Middleware.php');

        $this->publishes([
            $source => $destination,
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
