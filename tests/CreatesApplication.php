<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication()
    {
        $this->prepareTestingEnvironment();

        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    protected function prepareTestingEnvironment(): void
    {
        $connection = $this->envValue('DB_CONNECTION', 'mysql');

        if ($connection !== 'sqlite' || extension_loaded('pdo_sqlite')) {
            return;
        }

        $fallback = $this->envValue('PHPUNIT_DB_CONNECTION', 'mysql');

        $this->overrideEnv('DB_CONNECTION', $fallback);

        if ($fallback !== 'mysql') {
            return;
        }

        $this->overrideEnv('DB_HOST', $this->envValue('PHPUNIT_DB_HOST', $this->envValue('DB_HOST', '127.0.0.1')));
        $this->overrideEnv('DB_PORT', $this->envValue('PHPUNIT_DB_PORT', $this->envValue('DB_PORT', '3306')));
        $this->overrideEnv('DB_DATABASE', $this->envValue('PHPUNIT_DB_DATABASE', $this->envValue('DB_DATABASE', 'laravel')));
        $this->overrideEnv('DB_USERNAME', $this->envValue('PHPUNIT_DB_USERNAME', $this->envValue('DB_USERNAME', 'root')));
        $this->overrideEnv('DB_PASSWORD', $this->envValue('PHPUNIT_DB_PASSWORD', $this->envValue('DB_PASSWORD', '')));
    }

    protected function overrideEnv(string $key, ?string $value): void
    {
        if ($value === null) {
            return;
        }

        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }

    protected function envValue(string $key, $default = null)
    {
        return $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key) ?? $default;
    }
}
