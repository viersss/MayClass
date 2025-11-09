<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use PDOException;
use RuntimeException;
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
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)],
            'phone' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'parent_name' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'student',
            'phone' => $data['phone'] ?? null,
            'gender' => $data['gender'] ?? null,
            'parent_name' => $data['parent_name'] ?? null,
            'address' => $data['address'] ?? null,
            'student_id' => $this->generateStudentId(),
        ]);

        return redirect()
            ->route('login')
            ->with('status', __('Akun berhasil dibuat. Silakan login untuk mulai belajar.'))
            ->withInput(['email' => $data['email']]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        try {
            if (! Auth::attempt($credentials, $request->boolean('remember'))) {
                return back()->withErrors([
                    'email' => __('auth.failed'),
                ])->onlyInput('email');
            }
        } catch (QueryException|PDOException $exception) {
            if ($this->isDatabaseConnectionIssue($exception)) {
                return back()->withErrors([
                    'email' => __('Koneksi ke database gagal. Pastikan layanan MySQL/XAMPP sudah berjalan dan pengaturan DB_HOST, DB_PORT, DB_USERNAME di file .env sesuai.'),
                ])->onlyInput('email');
            }

            throw $exception;
        }

        $request->session()->regenerate();

        return redirect()->intended($this->homeRouteFor(Auth::user()));
    }

    public function redirectToGoogle(Request $request)
    {
        if (Auth::check()) {
            return redirect()->to($this->homeRouteFor(Auth::user()));
        }

        $config = $this->googleConfig();
        $origin = $this->sanitizeAuthOrigin($request->query('from'));

        if (! $config) {
            return redirect()
                ->to($this->authOriginRoute($origin))
                ->withErrors([
                    'google' => __('Konfigurasi Google Sign-In belum disetel. Hubungi administrator MayClass.'),
                ]);
        }

        $state = Str::random(40);

        $request->session()->put('google_auth_state', $state);
        $request->session()->put('google_auth_popup', $request->boolean('popup'));
        $request->session()->put('google_auth_origin', $origin);

        $query = http_build_query([
            'client_id' => $config['client_id'],
            'redirect_uri' => $config['redirect'],
            'response_type' => 'code',
            'scope' => $this->googleScope(),
            'state' => $state,
            'prompt' => 'select_account',
            'include_granted_scopes' => 'true',
            'access_type' => 'offline',
            'display' => 'popup',
        ], '', '&', PHP_QUERY_RFC3986);

        return redirect()->away('https://accounts.google.com/o/oauth2/v2/auth?'.$query);
    }

    public function handleGoogleCallback(Request $request)
    {
        $config = $this->googleConfig();
        $origin = $this->sanitizeAuthOrigin($request->session()->pull('google_auth_origin'));
        $originRoute = $this->authOriginRoute($origin);

        if (! $config) {
            return redirect()
                ->to($originRoute)
                ->withErrors([
                    'google' => __('Konfigurasi Google Sign-In belum disetel. Hubungi administrator MayClass.'),
                ]);
        }

        if ($request->query('error')) {
            return redirect()
                ->to($originRoute)
                ->withErrors([
                    'google' => __('Proses login Google dibatalkan. Silakan coba lagi.'),
                ]);
        }

        $expectedState = (string) $request->session()->pull('google_auth_state', '');
        $isPopup = (bool) $request->session()->pull('google_auth_popup', false);
        $providedState = (string) $request->query('state', '');

        if ($expectedState === '' || $providedState === '' || ! hash_equals($expectedState, $providedState)) {
            return redirect()
                ->to($originRoute)
                ->withErrors([
                    'google' => __('Sesi login Google tidak valid. Silakan coba lagi.'),
                ]);
        }

        $code = (string) $request->query('code', '');

        if ($code === '') {
            return redirect()
                ->to($originRoute)
                ->withErrors([
                    'google' => __('Google tidak mengirimkan kode otorisasi. Silakan coba lagi.'),
                ]);
        }

        try {
            $accessToken = $this->requestGoogleAccessToken($config, $code);
            $profile = $this->requestGoogleProfile($accessToken);
            $redirectUrl = $this->authenticateWithGoogleProfile($request, $profile);
        } catch (RuntimeException $exception) {
            return redirect()
                ->to($originRoute)
                ->withErrors([
                    'google' => $exception->getMessage(),
                ]);
        }

        if ($isPopup) {
            return view('auth.google-close', [
                'redirectUrl' => $redirectUrl,
            ]);
        }

        return redirect()->intended($redirectUrl);
    }

    public function prepareGooglePopup(Request $request): JsonResponse
    {
        if (Auth::check()) {
            return response()->json([
                'redirect' => $this->homeRouteFor(Auth::user()),
            ]);
        }

        $config = $this->googleConfig();

        if (! $config) {
            return response()->json([
                'message' => __('Konfigurasi Google Sign-In belum disetel. Hubungi administrator MayClass.'),
            ], 422);
        }

        $state = Str::random(40);
        $origin = $this->sanitizeAuthOrigin($request->input('from'));

        $request->session()->put('google_auth_state', $state);
        $request->session()->put('google_auth_popup', true);
        $request->session()->put('google_auth_origin', $origin);

        return response()->json([
            'state' => $state,
            'client_id' => $config['client_id'],
            'scope' => $this->googleScope(),
            'redirect_uri' => $config['redirect'],
        ]);
    }

    public function handleGooglePopup(Request $request): JsonResponse
    {
        if (Auth::check()) {
            return response()->json([
                'redirect' => $this->homeRouteFor(Auth::user()),
            ]);
        }

        $config = $this->googleConfig();

        if (! $config) {
            return response()->json([
                'message' => __('Konfigurasi Google Sign-In belum disetel. Hubungi administrator MayClass.'),
            ], 422);
        }

        $validated = $request->validate([
            'code' => ['required', 'string'],
            'state' => ['required', 'string'],
        ]);

        $expectedState = (string) $request->session()->pull('google_auth_state', '');
        $origin = $this->sanitizeAuthOrigin($request->session()->pull('google_auth_origin'));
        $originRoute = $this->authOriginRoute($origin);

        if ($expectedState === '' || ! hash_equals($expectedState, (string) $validated['state'])) {
            return response()->json([
                'message' => __('Sesi login Google tidak valid. Muat ulang halaman ini lalu coba lagi.'),
            ], 419);
        }

        try {
            $accessToken = $this->requestGoogleAccessToken($config, (string) $validated['code']);
            $profile = $this->requestGoogleProfile($accessToken);
            $redirectUrl = $this->authenticateWithGoogleProfile($request, $profile);
        } catch (RuntimeException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'redirect' => $originRoute,
            ], 422);
        }

        return response()->json([
            'redirect' => $redirectUrl,
        ]);
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

    private function googleConfig(): ?array
    {
        $config = config('services.google');

        if (! is_array($config)) {
            return null;
        }

        if (empty($config['client_id']) || empty($config['client_secret']) || empty($config['redirect'])) {
            return null;
        }

        return $config;
    }

    private function googleScope(): string
    {
        return 'openid email profile';
    }

    private function requestGoogleAccessToken(array $config, string $code): string
    {
        try {
            $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
                'code' => $code,
                'client_id' => $config['client_id'],
                'client_secret' => $config['client_secret'],
                'redirect_uri' => $config['redirect'],
                'grant_type' => 'authorization_code',
            ]);
        } catch (Throwable $exception) {
            throw new RuntimeException(__('Gagal terhubung ke Google. Periksa koneksi internet Anda lalu coba lagi.'));
        }

        if (! $response->successful()) {
            throw new RuntimeException(__('Google menolak permintaan login. Silakan coba lagi.'));
        }

        $accessToken = (string) ($response->json('access_token') ?? '');

        if ($accessToken === '') {
            throw new RuntimeException(__('Token akses Google tidak tersedia. Silakan coba lagi.'));
        }

        return $accessToken;
    }

    private function requestGoogleProfile(string $accessToken): array
    {
        try {
            $response = Http::withToken($accessToken)->get('https://openidconnect.googleapis.com/v1/userinfo');
        } catch (Throwable $exception) {
            throw new RuntimeException(__('Gagal mengambil data profil Google. Silakan coba lagi.'));
        }

        if (! $response->successful()) {
            throw new RuntimeException(__('Google tidak mengembalikan profil pengguna. Silakan coba lagi.'));
        }

        $profile = $response->json();

        if (! is_array($profile)) {
            throw new RuntimeException(__('Data profil Google tidak valid. Silakan coba lagi.'));
        }

        return $profile;
    }

    private function authenticateWithGoogleProfile(Request $request, array $profile): string
    {
        $email = (string) ($profile['email'] ?? '');

        if ($email === '') {
            throw new RuntimeException(__('Google tidak menyediakan alamat email Anda. Gunakan cara login lain.'));
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            $user = new User();
            $user->name = $this->resolveGoogleName($profile, $email);
            $user->email = $email;
            $user->role = 'student';
            $user->student_id = $this->generateStudentId();
            $user->password = Hash::make(Str::random(40));
            $user->email_verified_at = ($profile['email_verified'] ?? false) ? now() : null;

            if (! empty($profile['picture'])) {
                $user->avatar_path = (string) $profile['picture'];
            }

            $user->save();
        } else {
            $hasChanges = false;

            if (! $user->email_verified_at && ($profile['email_verified'] ?? false)) {
                $user->email_verified_at = now();
                $hasChanges = true;
            }

            if (! $user->name && ! empty($profile['name'])) {
                $user->name = (string) $profile['name'];
                $hasChanges = true;
            }

            if (! $user->student_id && $user->role === 'student') {
                $user->student_id = $this->generateStudentId();
                $hasChanges = true;
            }

            if (! $user->avatar_path && ! empty($profile['picture'])) {
                $user->avatar_path = (string) $profile['picture'];
                $hasChanges = true;
            }

            if ($hasChanges) {
                $user->save();
            }
        }

        Auth::login($user);
        $request->session()->regenerate();

        return $this->homeRouteFor($user);
    }

    private function sanitizeAuthOrigin(?string $origin): string
    {
        return $origin === 'register' ? 'register' : 'login';
    }

    private function authOriginRoute(string $origin): string
    {
        return $origin === 'register' ? route('register') : route('login');
    }

    private function resolveGoogleName(array $profile, string $email): string
    {
        if (! empty($profile['name'])) {
            return (string) $profile['name'];
        }

        if (! empty($profile['given_name']) || ! empty($profile['family_name'])) {
            return trim(sprintf('%s %s', (string) ($profile['given_name'] ?? ''), (string) ($profile['family_name'] ?? '')));
        }

        return $email;
    }
}

