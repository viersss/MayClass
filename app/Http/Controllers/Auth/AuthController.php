<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Database\Schema\Blueprint;
use PDOException;
use Throwable;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect()->to($this->homeRouteFor(Auth::user()));
        }

        return view('auth.index', [
            'mode' => 'login',
            'profile' => $request->session()->get('register.profile', []),
            'captcha' => $this->generateCaptchaChallenge($request),
        ]);
    }

    public function showRegister(Request $request)
    {
        if (Auth::check()) {
            return redirect()->to($this->homeRouteFor(Auth::user()));
        }

        return view('auth.index', [
            'mode' => 'register',
            'profile' => $request->session()->get('register.profile', []),
            'captcha' => $this->generateCaptchaChallenge($request),
        ]);
    }

    public function join(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('login');
    }

    public function showForgotPassword(Request $request)
    {
        if (Auth::check()) {
            return redirect()->to($this->homeRouteFor(Auth::user()));
        }

        $supportNumber = config('services.whatsapp.support_admin', '6281234567890');
        $message = __('Halo Admin MayClass, saya membutuhkan bantuan untuk mereset password akun siswa MayClass.');

        return view('auth.forgot', [
            'whatsappLink' => $this->buildWhatsappLink($supportNumber, $message),
            'whatsappNumber' => $this->formatWhatsappNumber($supportNumber),
        ]);
    }

    public function storeRegisterDetails(Request $request): RedirectResponse
    {
        $this->ensureUsernameSupport();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'min:4', 'max:50', Rule::unique(User::class, 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)],
            'phone' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'captcha_answer' => ['required', 'string', function ($attribute, $value, $fail) use ($request) {
                $expected = (string) $request->session()->get('register.captcha_answer');

                if ($expected === '' || $expected === null) {
                    $fail(__('Captcha tidak tersedia. Muat ulang halaman dan coba lagi.'));

                    return;
                }

                if (trim((string) $value) !== $expected) {
                    $fail(__('Jawaban captcha tidak sesuai.'));
                }
            }],
        ]);

        unset($data['captcha_answer']);

        $request->session()->forget('register.captcha_answer');

        $request->session()->put('register.profile', $data);

        return redirect()->route('register.password');
    }

    public function showPasswordStep(Request $request)
    {
        if (Auth::check()) {
            return redirect()->to($this->homeRouteFor(Auth::user()));
        }

        $profile = $request->session()->get('register.profile');

        if (! $profile) {
            return redirect()->route('register')->with('status', __('Silakan lengkapi data diri terlebih dahulu.'));
        }

        return view('auth.register-password', [
            'profile' => $profile,
        ]);
    }

    public function register(Request $request): RedirectResponse
    {
        $this->ensureUsernameSupport();

        $profile = $request->session()->get('register.profile');

        if (! $profile) {
            return redirect()->route('register')->with('status', __('Silakan lengkapi data diri terlebih dahulu.'));
        }

        $profileValidator = Validator::make($profile, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'min:4', 'max:50', Rule::unique(User::class, 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)],
            'phone' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
        ]);

        if ($profileValidator->fails()) {
            return redirect()
                ->route('register')
                ->withErrors($profileValidator)
                ->withInput($profile);
        }

        $passwordData = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $profile['name'],
            'username' => $profile['username'],
            'email' => $profile['email'],
            'password' => Hash::make($passwordData['password']),
            'role' => 'visitor',
            'phone' => $profile['phone'] ?? null,
            'gender' => $profile['gender'] ?? null,
        ]);

        $request->session()->forget('register.profile');

        return redirect()
            ->route('login')
            ->with('register_success', true)
            ->with('status', __('Akun berhasil dibuat. Silakan login untuk mulai belajar.'))
            ->with('register_success', true)
            ->withInput(['username' => $profile['username']]);
    }

    public function login(Request $request): RedirectResponse
    {
        $this->ensureUsernameSupport();

        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        try {
            if (! Auth::attempt($credentials, $request->boolean('remember'))) {
                return back()->withErrors([
                    'username' => __('auth.failed'),
                ])->onlyInput('username');
            }
        } catch (QueryException|PDOException $exception) {
            if ($this->isDatabaseConnectionIssue($exception)) {
                return back()->withErrors([
                    'username' => __('Koneksi ke database gagal. Pastikan layanan MySQL/XAMPP sudah berjalan dan pengaturan DB_HOST, DB_PORT, DB_USERNAME di file .env sesuai.'),
                ])->onlyInput('username');
            }

            throw $exception;
        }

        // ✅ Tidak perlu Auth::login($user)
        $request->session()->regenerate();

        return redirect()->intended($this->homeRouteFor(Auth::user()));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function homeRouteFor(?User $user): string
    {
        if (! $user) {
            return route('login');
        }

        return match ($user->role) {
            'tutor' => route('tutor.dashboard'),
            'student' => route('student.dashboard'),
            'admin' => route('admin.dashboard'),
            'visitor' => route('packages.index'),
            default => route('packages.index'),
        };
    }

    private function generateCaptchaChallenge(Request $request): array
    {
        $first = random_int(2, 9);
        $second = random_int(1, 8);
        $operators = ['+', '−'];
        $operator = $operators[array_rand($operators)];

        if ($operator === '−' && $second > $first) {
            [$first, $second] = [$second, $first];
        }

        $answer = $operator === '+'
            ? $first + $second
            : $first - $second;

        $request->session()->put('register.captcha_answer', (string) $answer);

        return [
            'question' => sprintf('%d %s %d = ?', $first, $operator, $second),
            'hint' => __('Masukkan jawaban dalam bentuk angka.'),
        ];
    }

    private function buildWhatsappLink(string $number, string $message): string
    {
        $target = $this->normalizePhoneNumber($number);

        return "https://wa.me/{$target}?text=" . rawurlencode($message);
    }

    private function formatWhatsappNumber(string $number): string
    {
        $target = $this->normalizePhoneNumber($number);

        return '+' . $target;
    }

    private function normalizePhoneNumber(string $number): string
    {
        $digits = preg_replace('/[^0-9]/', '', (string) $number) ?: '6281234567890';

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return ltrim($digits, '+');
    }

    private function isDatabaseConnectionIssue(Throwable $exception): bool
    {
        $message = strtolower($exception->getMessage());

        if (str_contains($message, 'connection refused') || str_contains($message, 'actively refused')) {
            return true;
        }

        if ($exception instanceof QueryException && $exception->getPrevious()) {
            return $this->isDatabaseConnectionIssue($exception->getPrevious());
        }

        if ($exception instanceof PDOException && (int) $exception->getCode() === 2002) {
            return true;
        }

        return false;
    }

    private function ensureUsernameSupport(): void
    {
        try {
            if (! Schema::hasTable('users')) {
                return;
            }

            if (Schema::hasColumn('users', 'username')) {
                return;
            }

            Schema::table('users', function (Blueprint $table) {
                $table->string('username', 50)->nullable()->unique()->after('name');
            });

            User::query()
                ->whereNull('username')
                ->orderBy('id')
                ->chunkById(100, function ($users) {
                    foreach ($users as $user) {
                        $user->forceFill([
                            'username' => $this->generateFallbackUsername($user),
                        ])->save();
                    }
                });
        } catch (Throwable $exception) {
            Log::error('Unable to ensure username support for authentication.', [
                'message' => $exception->getMessage(),
            ]);

            abort(500, __('Kolom username belum tersedia di database. Jalankan migrasi database MayClass kemudian coba lagi.'));
        }
    }

    private function generateFallbackUsername(User $user): string
    {
        $base = Str::slug($user->name) ?: 'user';
        $base = substr($base, 0, 40);

        if ($base === '') {
            $base = 'user';
        }

        $candidate = $base;

        if (! User::where('username', $candidate)->exists()) {
            return $candidate;
        }

        $candidate = rtrim(substr($base, 0, 32), '-') . '-' . $user->id;

        while (User::where('username', $candidate)->exists()) {
            $candidate = rtrim(substr($base, 0, 30), '-') . '-' . random_int(1000, 9999);
        }

        return $candidate;
    }
}

