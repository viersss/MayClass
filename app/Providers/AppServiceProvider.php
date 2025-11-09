<?php

namespace App\Providers;

use App\Support\Database\FallbackMySqlConnector;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerDatabaseFallbackConnector();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function registerDatabaseFallbackConnector(): void
    {
        $this->app->extend('db.connector.mysql', function () {
            return new FallbackMySqlConnector();
        });

        $this->app->extend('db.connector.mariadb', function () {
            return new FallbackMySqlConnector();
        });
    }
}
