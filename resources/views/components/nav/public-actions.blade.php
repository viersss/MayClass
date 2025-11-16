@php
    $variant = $variant ?? 'default';
    $authUser = auth()->user();
    $avatarPlaceholder = asset('images/avatar-placeholder.svg');
@endphp

@if ($authUser)
    @php
        $avatarUrl = \App\Support\AvatarResolver::resolve([$authUser->avatar_path]) ?? $avatarPlaceholder;
        $profileUrl = match ($authUser->role) {
            'tutor' => route('tutor.account.edit'),
            'admin' => route('admin.account.edit'),
            default => route('student.profile'),
        };
    @endphp
    <a class="nav-chip" href="{{ $profileUrl }}">
        <span class="nav-chip__avatar">
            <img src="{{ $avatarUrl }}" alt="Avatar {{ $authUser->name }}" loading="lazy" />
        </span>
        <span class="nav-chip__label">Profile</span>
    </a>
    @if ($authUser->role === 'student')
        <a class="nav-btn nav-btn--filled" href="{{ route('student.dashboard') }}">Mulai Belajar</a>
    @endif
@else
    @if ($variant === 'landing')
        <a class="nav-btn nav-btn--filled" href="{{ route('join') }}">Gabung Sekarang</a>
    @else
        <a class="nav-btn nav-btn--ghost" href="{{ route('login') }}">Masuk</a>
        <a class="nav-btn nav-btn--filled" href="{{ route('register') }}">Daftar</a>
    @endif
@endif
