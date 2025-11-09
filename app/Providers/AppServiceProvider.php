<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use PDOException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->ensureDatabaseHostFallback();
    }

    private function ensureDatabaseHostFallback(): void
    {
        $connection = config('database.default');

        if (! in_array($connection, ['mysql', 'mariadb'], true)) {
            return;
        }

        $originalHost = config("database.connections.{$connection}.host");

        try {
            DB::connection($connection)->getPdo();

            return;
        } catch (PDOException $exception) {
            if (! $this->isConnectionRefused($exception)) {
                throw $exception;
            }

            $this->attemptFallbackHosts($connection, $originalHost, $exception);
        }
    }

    private function attemptFallbackHosts(string $connection, ?string $originalHost, PDOException $originalException): void
    {
        $fallbackHosts = array_values(array_unique(array_filter([
            env('DB_FAILOVER_HOST'),
            '127.0.0.1',
            'localhost',
        ], fn ($host) => $host && $host !== $originalHost)));

        $lastException = $originalException;

        foreach ($fallbackHosts as $host) {
            config(["database.connections.{$connection}.host" => $host]);
            DB::purge($connection);

            try {
                DB::connection($connection)->getPdo();

                if ($host !== $originalHost) {
                    Log::notice('Database host fallback engaged for MayClass.', [
                        'connection' => $connection,
                        'from' => $originalHost,
                        'to' => $host,
                    ]);
                }

                return;
            } catch (PDOException $exception) {
                if (! $this->isConnectionRefused($exception)) {
                    throw $exception;
                }

                $lastException = $exception;
            }
        }

        config(["database.connections.{$connection}.host" => $originalHost]);
        DB::purge($connection);

        Log::warning('Unable to resolve database connection host for MayClass.', [
            'connection' => $connection,
            'tried_hosts' => $fallbackHosts,
            'message' => $lastException->getMessage(),
        ]);

        throw $originalException;
    }

    private function isConnectionRefused(PDOException $exception): bool
    {
        if ((int) $exception->getCode() === 2002) {
            return true;
        }

        $message = strtolower($exception->getMessage());

        return str_contains($message, 'connection refused')
            || str_contains($message, 'actively refused');
    }
}
