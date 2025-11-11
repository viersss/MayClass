<?php

namespace App\Providers;

use App\Models\User;
use App\Support\Database\FallbackMySqlConnector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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

        $tutor = $this->ensureDemoUser(
            'tentor_demo',
            'tentor@gmail.com',
            'gatau123',
            [
                'name' => 'Tentor Demo MayClass',
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

        $this->ensureDemoUser(
            'admin_utama',
            'admin@gmail.com',
            'gatau123',
            [
                'name' => 'Admin Utama MayClass',
                'role' => 'admin',
                'phone' => '0812-7777-1234',
                'gender' => 'other',
                'address' => 'Jl. Pengelola Pendidikan No. 1, Bandung',
            ]
        );
    }

    private function ensureDemoUser(string $username, string $email, string $plainPassword, array $attributes): ?User
    {
        $user = User::firstOrNew(['email' => $email]);

        try {
            $columns = Schema::getColumnListing('users');
        } catch (Throwable $exception) {
            Log::debug('Unable to load user columns while provisioning demo accounts.', [
                'message' => $exception->getMessage(),
            ]);

            $columns = [];
        }

        $payload = [];
        $columnSet = array_fill_keys($columns, true);

        if ($columnSet === []) {
            $columnSet = [
                'email' => true,
                'name' => true,
                'role' => true,
            ];
        }

        $baseAttributes = array_merge(
            [
                'email' => $email,
                'username' => $username,
            ],
            $attributes
        );

        foreach ($baseAttributes as $column => $value) {
            if (isset($columnSet[$column])) {
                $payload[$column] = $value;
            }
        }

        $user->fill($payload);

        if (! $user->exists || empty($user->password) || ! Hash::check($plainPassword, $user->password)) {
            $user->password = Hash::make($plainPassword);
        }

        $user->save();

        return $user->fresh();
    }
}
