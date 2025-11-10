<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use PDOException;
use Throwable;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->to($this->homeRouteFor(Auth::user()));
        }

        return view('auth.index', ['mode' => 'login']);
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->to($this->homeRouteFor(Auth::user()));
        }

        return view('auth.index', ['mode' => 'register']);
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

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'min:4', 'max:50', Rule::unique(User::class, 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)],
            'phone' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'student',
            'phone' => $data['phone'] ?? null,
            'gender' => $data['gender'] ?? null,
            'student_id' => $this->generateStudentId(),
        ]);

        return redirect()
            ->route('login')
            ->with('status', __('Akun berhasil dibuat. Silakan login untuk mulai belajar.'))
            ->withInput(['username' => $data['username']]);
    }

    public function login(Request $request): RedirectResponse
    {
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

    private function generateStudentId(): string
    {
        do {
            $id = 'MC-' . str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (User::where('student_id', $id)->exists());

        return $id;
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
            default => route('packages.index'),
        };
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
}

