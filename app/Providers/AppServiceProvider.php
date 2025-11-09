<?php

namespace App\Providers;

use App\Models\User;
use App\Support\Database\FallbackMySqlConnector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDOException;
use Throwable;

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
        $this->ensureDemoAccounts();
        $this->ensureDatabaseHostFallback();
    }

    /**
     * Registrasi konektor fallback MySQL/MariaDB.
     */
    private function registerDatabaseFallbackConnector(): void
    {
        $this->app->extend('db.connector.mysql', function () {
            return new FallbackMySqlConnector();
        });

        $this->app->extend('db.connector.mariadb', function () {
            return new FallbackMySqlConnector();
        });
    }

    /**
     * Membuat akun demo (tidak untuk production).
     */
    private function ensureDemoAccounts(): void
    {
        if (app()->environment('production')) {
            return;
        }

        try {
            if (! Schema::hasTable('users')) {
                return;
            }
        } catch (Throwable $exception) {
            Log::debug('Skipping demo account provisioning while schema unavailable.', [
                'message' => $exception->getMessage(),
            ]);

            return;
        }

        $tutor = User::updateOrCreate(
            ['email' => 'tentor@gmail.com'],
            [
                'name' => 'Tentor Demo MayClass',
                'password' => 'gatau123',
                'role' => 'tutor',
                'phone' => '0812-0000-1234',
                'gender' => 'other',
                'address' => 'Jl. Ilmu Pendidikan No. 10, Bandung',
            ]
        );

        if ($tutor && Schema::hasTable('tutor_profiles')) {
            $tutor->tutorProfile()->updateOrCreate(
                ['user_id' => $tutor->id],
                [
                    'slug' => Str::slug($tutor->name) ?: 'tutor-demo-mayclass',
                    'headline' => 'Tutor Sains & Matematika',
                    'bio' => 'Berpengalaman mendampingi siswa menyiapkan ujian masuk perguruan tinggi dan Olimpiade Sains dengan pendekatan belajar adaptif.',
                    'specializations' => 'Matematika SMA',
                    'education' => 'S1 Pendidikan Matematika',
                    'experience_years' => 5,
                    'students_taught' => 128,
                    'hours_taught' => 860,
                    'rating' => 4.8,
                    'certifications' => [
                        'Sertifikasi Pengajar Profesional 2023',
                        'Pelatihan Kurikulum Merdeka',
                    ],
                ]
            );
        }

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Utama MayClass',
                'password' => 'gatau123',
                'role' => 'admin',
                'phone' => '0812-7777-1234',
                'gender' => 'other',
                'address' => 'Jl. Pengelola Pendidikan No. 1, Bandung',
            ]
        );
    }

    /**
     * Fallback host database jika koneksi utama gagal.
     */
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
