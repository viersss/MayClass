<?php

namespace App\Providers;

use App\Support\Database\FallbackMySqlConnector;
use Illuminate\Database\Connection;
use Illuminate\Database\MySqlConnection;
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
        $resolver = static function ($connection, $database, $prefix, $config) {
            $connector = new FallbackMySqlConnector();

            $pdo = $connector->connect($config);

            return new MySqlConnection($pdo, $database, $prefix, $config);
        };

        Connection::resolverFor('mysql', $resolver);
        Connection::resolverFor('mariadb', $resolver);
    }
}
