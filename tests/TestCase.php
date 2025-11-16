<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Config;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function refreshApplication(): void
    {
        parent::refreshApplication();

        if ($this->shouldFallbackToMysql()) {
            $this->useMysqlForTesting();
        }
    }

    protected function shouldFallbackToMysql(): bool
    {
        return config('database.default') === 'sqlite'
            && ! extension_loaded('pdo_sqlite');
    }

    protected function useMysqlForTesting(): void
    {
        $connection = env('PHPUNIT_DB_CONNECTION', 'mysql');

        Config::set('database.default', $connection);

        if ($connection === 'mysql') {
            Config::set('database.connections.mysql.database', env('PHPUNIT_DB_DATABASE', env('DB_DATABASE', 'laravel')));
            Config::set('database.connections.mysql.username', env('PHPUNIT_DB_USERNAME', env('DB_USERNAME', 'root')));
            Config::set('database.connections.mysql.password', env('PHPUNIT_DB_PASSWORD', env('DB_PASSWORD', '')));
            Config::set('database.connections.mysql.host', env('PHPUNIT_DB_HOST', env('DB_HOST', '127.0.0.1')));
            Config::set('database.connections.mysql.port', env('PHPUNIT_DB_PORT', env('DB_PORT', '3306')));
        }
    }
}
