<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Admin - MayClass')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    {{-- Bootstrap 4 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --surface: #ffffff;
            --surface-muted: #f1f5f9;
            --border: #e2e8f0;
            --text: #0f172a;
            --text-muted: #6b7280;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --sidebar: #0f172a;
            --sidebar-muted: #1f2937;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--surface-muted);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .dashboard-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 32px;
            padding: 32px 40px;
        }

        .nav-panel {
            background: var(--sidebar);
            border-radius: 24px;
            padding: 28px 24px;
            color: #fff;
            display: flex;
            flex-direction: column;
            gap: 24px;
            position: sticky;
            top: 32px;
            align-self: start;
            min-height: calc(100vh - 64px);
        }

        .navigation {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85);
            transition: background 0.2s ease, color 0.2s ease;
            font-size: 0.95rem;
        }

        .nav-link[data-active='true'] {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
        }

        .nav-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            display: grid;
            place-items: center;
        }

        .nav-icon svg {
            width: 22px;
            height: 22px;
        }

        .nav-footer {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .profile-summary {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.1);
            color: inherit;
        }

        .profile-summary img {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .profile-summary strong {
            display: block;
            font-size: 1rem;
        }

        .profile-summary small {
            color: rgba(255, 255, 255, 0.7);
        }

        .logout-btn {
            width: 100%;
        }

        .logout-btn button {
            width: 100%;
            padding: 14px 20px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.28);
            background: #0d162d;
            color: #fff;
            font: inherit;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        .logout-btn button:hover {
            background: #0f1c3d;
            border-color: rgba(255, 255, 255, 0.45);
            transform: translateY(-1px);
        }

        .main-area {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .main-header {
            background: var(--surface);
            border-radius: 20px;
            padding: 24px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid var(--border);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        /* --- GENERIC FORM STYLES (PREMIUM) --- */
        .admin-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .admin-card h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 16px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.75rem;
            /* Smaller, cleaner */
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 0;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            background: #fff;
            font-size: 0.95rem;
            transition: all 0.2s;
            color: #0f172a;
            font-family: inherit;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* Toggle Switch Style */
        .form-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .form-toggle:hover {
            border-color: #cbd5e1;
        }

        .form-toggle input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: #2563eb;
            cursor: pointer;
        }

        .form-toggle span {
            font-weight: 600;
            color: #334155;
            font-size: 0.95rem;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }

        /* Reuse button styles */
        .btn-cancel {
            padding: 12px 24px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .btn-submit {
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            transition: all 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
        }

        /* --- TENTOR SPECIFIC (Keep for backward compatibility if needed, or refactor) --- */
        .header-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .header-profile-link {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: 2px solid var(--border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--surface-muted);
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.12);
        }

        .header-profile-link img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .date-pill {
            padding: 8px 14px;
            border-radius: 999px;
            background: var(--surface-muted);
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 0.9rem;
        }

        .page-wrapper {
            position: relative;
            padding-bottom: 48px;
        }

        main {
            flex: 1;
        }

        .page-content {
            display: block;
            max-width: 1240px;
        }

        .flash-message {
            margin-bottom: 24px;
            padding: 14px 18px;
            border-radius: 14px;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #15803d;
            font-weight: 500;
        }

        @media (max-width: 1240px) {
            .dashboard-shell {
                grid-template-columns: 240px 1fr;
                padding: 24px;
            }
        }

        @media (max-width: 1024px) {
            .dashboard-shell {
                grid-template-columns: 1fr;
                padding: 20px;
            }

            .nav-panel {
                position: static;
                flex-direction: row;
                flex-wrap: wrap;
                gap: 16px;
                max-height: none;
            }

            .navigation {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
            }

            .nav-footer {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .main-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .header-meta {
                width: 100%;
                flex-wrap: wrap;
                gap: 10px;
            }
        }

        /* --- RESPONSIVE ADMIN NAVBAR (Mobile/Tablet) --- */
        .mobile-admin-header {
            display: none;
            /* Hidden on desktop */
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 40;
            margin: -32px -40px 32px -40px;
            /* Negate shell padding */
        }

        .mobile-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--sidebar);
        }

        .mobile-brand img {
            height: 40px;
            width: auto;
        }

        .hamburger-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: var(--sidebar);
            border-radius: 8px;
        }

        .hamburger-btn:hover {
            background: rgba(15, 23, 42, 0.05);
        }

        /* Mobile Dropdown (Gray Glass) */
        .mobile-nav-expanded {
            position: absolute;
            top: 70px;
            /* Below header */
            left: 16px;
            right: 16px;
            background: rgba(15, 23, 42, 0.9);
            /* Dark Slate Glass */
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            z-index: 100;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 16px;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .mobile-nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateX(4px);
        }

        .mobile-nav-link.is-active {
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .mobile-nav-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 10px 0;
        }

        .mobile-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            margin-bottom: 8px;
        }

        .mobile-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .mobile-profile div {
            display: flex;
            flex-direction: column;
        }

        .mobile-profile strong {
            color: #fff;
            font-size: 0.95rem;
        }

        .mobile-profile small {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
        }

        @media (max-width: 1024px) {
            .dashboard-shell {
                grid-template-columns: 1fr;
                padding: 24px;
                display: block;
                /* Reset grid for mobile flow */
            }

            .nav-panel {
                display: none !important;
                /* Hide sidebar on mobile */
            }

            .mobile-admin-header {
                display: flex !important;
                /* Show mobile header */
                margin: -24px -24px 24px -24px;
                /* Adjust for shell padding */
                padding: 16px 24px;
            }
        }

        @media (max-width: 640px) {
            .dashboard-shell {
                padding: 20px;
            }

            .mobile-admin-header {
                margin: -20px -20px 24px -20px;
                padding: 14px 20px;
            }
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        /* --- PREMIUM MODAL STYLES --- */
        [x-cloak] {
            display: none !important;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            /* Darker, richer backdrop */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-backdrop.show {
            opacity: 1;
        }

        .modal-content {
            background: #ffffff;
            border-radius: 24px;
            /* Softer corners */
            box-shadow:
                0 0 0 1px rgba(255, 255, 255, 0.5) inset,
                0 25px 50px -12px rgba(0, 0, 0, 0.35);
            width: 100%;
            max-width: 680px;
            /* Slightly wider */
            max-height: 85vh;
            overflow-y: auto;
            transform: scale(0.92) translateY(10px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            /* Spring-like animation */
            position: relative;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .modal-content::-webkit-scrollbar {
            width: 6px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }

        .modal-backdrop.show .modal-content {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .modal-header {
            padding: 24px 32px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            z-index: 10;
        }

        .modal-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.02em;
            margin: 0;
        }

        .modal-close {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #64748b;
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            transition: all 0.2s;
        }

        .modal-close:hover {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 32px;
        }

        /* --- FORM STYLES --- */
        .tentor-form-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .tentor-form-card h2 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 4px 0;
        }

        .tentor-form-card p {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0 0 20px 0;
        }

        .tentor-avatar-field {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }

        .tentor-avatar-field img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .tentor-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .tentor-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .tentor-form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .tentor-form-group input,
        .tentor-form-group textarea,
        .tentor-form-group select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            background: #fff;
            font-size: 0.95rem;
            transition: all 0.2s;
            color: #0f172a;
        }

        .tentor-form-group input:focus,
        .tentor-form-group textarea:focus,
        .tentor-form-group select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .tentor-form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .helper-text {
            font-size: 0.8rem;
            color: #94a3b8;
            margin: 4px 0 0 0;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            transition: all 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
        }

        .btn-secondary {
            background: #fff;
            color: #475569;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-block;
            text-align: center;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #1e293b;
        }

        .tentor-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .tentor-status-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            width: fit-content;
        }

        .tentor-status-toggle input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #2563eb;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .tentor-form-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                max-height: 100vh;
                border-radius: 0;
            }
        </style>
        @stack('styles')
    </head>
    <body>
        <div class="dashboard-shell">
            <aside class="nav-panel">
                <nav class="navigation">
                    @php
                        $currentRoute = request()->route() ? request()->route()->getName() : null;
                        $menuItems = [
                            [
                                'label' => 'Beranda',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 11.5 12 4l9 7.5" /><path stroke-linecap="round" stroke-linejoin="round" d="M5 10v9h4v-5h6v5h4v-9" /></svg>',
                                'route' => 'admin.dashboard',
                                'patterns' => ['admin.dashboard'],
                            ],
                            [
                                'label' => 'Manajemen Jadwal',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M8 3v2m8-2v2" /><rect width="18" height="16" x="3" y="5" rx="2" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" /></svg>',
                                'route' => 'admin.schedules.index',
                                'patterns' => ['admin.schedules.*', 'admin.schedule.*'],
                            ],
                            [
                                'label' => 'Manajemen Siswa',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M7 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm10 0a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2 20a4.5 4.5 0 0 1 4.5-4.5H9a4.5 4.5 0 0 1 4.5 4.5v1H2zm9.5 1v-1A4.5 4.5 0 0 1 16 15.5h2.5A4.5 4.5 0 0 1 23 20v1z" /></svg>',
                                'route' => 'admin.students.index',
                                'patterns' => ['admin.students.*'],
                            ],
                            [
                                'label' => 'Manajemen Tentor',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 0-6 0 3 3 0 0 0 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21a4.5 4.5 0 0 0-9 0Zm0 0H21a2 2 0 0 0 2-2v-1a8 8 0 0 0-8-8h-6a8 8 0 0 0-8 8v1a2 2 0 0 0 2 2h1.5" /></svg>',
                                'route' => 'admin.tentors.index',
                                'patterns' => ['admin.tentors.*'],
                            ],
                            [
                                'label' => 'Manajemen Paket',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7 12 3l9 4v10l-9 4-9-4z" /><path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 4 9-4" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 11v10" /></svg>',
                                'route' => 'admin.packages.index',
                                'patterns' => ['admin.packages.*'],
                            ],
                            [
                                'label' => 'Mata Pelajaran',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>',
                                'route' => 'admin.subjects.index',
                                'patterns' => ['admin.subjects.*'],
                            ],
                            [
                                'label' => 'Manajemen Keuangan',
                                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h14a2 2 0 0 1 2 2v8a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V9a2 2 0 0 1 2-2z" /><path stroke-linecap="round" stroke-linejoin="round" d="M18 11h3v4h-3a2 2 0 0 1 0-4z" /></svg>',
                                'route' => 'admin.finance.index',
                                'patterns' => ['admin.finance.*'],
                            ],
                        ];
                        $adminSummaryAvatar = \App\Support\ProfileAvatar::forUser($admin);
                    @endphp
                    @foreach ($menuItems as $item)
                        @php
                            $isActive = false;
                            foreach ($item['patterns'] as $pattern) {
                                if ($currentRoute && \Illuminate\Support\Str::is($pattern, $currentRoute)) {
                                    $isActive = true;
                                    break;
                                }
                            }
                        @endphp
                        <a href="{{ route($item['route']) }}" class="nav-link" data-active="{{ $isActive ? 'true' : 'false' }}">
                            <span class="nav-icon" aria-hidden="true">{!! $item['icon'] !!}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
                <div class="nav-footer">
                    <a class="profile-summary" href="{{ route('admin.account.edit') }}" title="Kelola profil admin">
                        <img
                            src="{{ $adminSummaryAvatar }}"
                            alt="Foto admin"
                        />
                        <div>
                            <strong>{{ $admin?->name ?? 'Admin MayClass' }}</strong>
                        </div>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="logout-btn">
                        @csrf
                        <button type="submit" title="Keluar dari dashboard">
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </aside>
            <div class="main-area">
                <main>
                    <div class="page-wrapper">
                        <div class="page-content">
                            @if (session('status'))
                                <div class="flash-message">{{ session('status') }}</div>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </main>
            </div>
            <button class="hamburger-btn" @click="mobileMenuOpen = !mobileMenuOpen">
                <svg x-show="!mobileMenuOpen" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="8" x2="20" y2="8"></line>
                    <line x1="4" y1="16" x2="20" y2="16"></line>
                </svg>
                <svg x-show="mobileMenuOpen" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="display: none;">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </header>

        <!-- Mobile Dropdown -->
        <div class="mobile-nav-expanded" x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" style="display: none;">

            <!-- Profile Info in Menu -->
            <div class="mobile-profile">
                <img src="{{ \App\Support\ProfileAvatar::forUser(auth()->user()) }}" alt="Admin">
                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>Administrator</small>
                </div>
            </div>

            <div class="mobile-nav-divider"></div>

            @php
                $currentRoute = request()->route() ? request()->route()->getName() : null;
                $menuItems = [
                    ['label' => 'Beranda', 'route' => 'admin.dashboard', 'patterns' => ['admin.dashboard'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 11.5 12 4l9 7.5" /><path stroke-linecap="round" stroke-linejoin="round" d="M5 10v9h4v-5h6v5h4v-9" />'],
                    ['label' => 'Manajemen Jadwal', 'route' => 'admin.schedules.index', 'patterns' => ['admin.schedules.*', 'admin.schedule.*'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 3v2m8-2v2" /><rect width="18" height="16" x="3" y="5" rx="2" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" />'],
                    ['label' => 'Manajemen Siswa', 'route' => 'admin.students.index', 'patterns' => ['admin.students.*'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm10 0a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2 20a4.5 4.5 0 0 1 4.5-4.5H9a4.5 4.5 0 0 1 4.5 4.5v1H2zm9.5 1v-1A4.5 4.5 0 0 1 16 15.5h2.5A4.5 4.5 0 0 1 23 20v1z" />'],
                    ['label' => 'Manajemen Tentor', 'route' => 'admin.tentors.index', 'patterns' => ['admin.tentors.*'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 0-6 0 3 3 0 0 0 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21a4.5 4.5 0 0 0-9 0Zm0 0H21a2 2 0 0 0 2-2v-1a8 8 0 0 0-8-8h-6a8 8 0 0 0-8 8v1a2 2 0 0 0 2 2h1.5" />'],
                    ['label' => 'Manajemen Paket', 'route' => 'admin.packages.index', 'patterns' => ['admin.packages.*'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 7 12 3l9 4v10l-9 4-9-4z" /><path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 4 9-4" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 11v10" />'],

                    ['label' => 'Manajemen Keuangan', 'route' => 'admin.finance.index', 'patterns' => ['admin.finance.*'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 7h14a2 2 0 0 1 2 2v8a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V9a2 2 0 0 1 2-2z" /><path stroke-linecap="round" stroke-linejoin="round" d="M18 11h3v4h-3a2 2 0 0 1 0-4z" />'],
                    ['label' => 'Manajemen Konten', 'route' => 'admin.content.index', 'patterns' => ['admin.content.*'], 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />'],
                ];
             @endphp

            @foreach ($menuItems as $item)
                @php
                    $isActive = false;
                    foreach ($item['patterns'] as $pattern) {
                        if ($currentRoute && \Illuminate\Support\Str::is($pattern, $currentRoute)) {
                            $isActive = true;
                            break;
                        }
                    }
                @endphp
                <a href="{{ route($item['route']) }}" class="mobile-nav-link {{ $isActive ? 'is-active' : '' }}">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        {!! $item['icon'] !!}
                    </svg>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach

            <div class="mobile-nav-divider"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mobile-nav-link" style="color: #fca5a5; width: 100%;">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

        <aside class="nav-panel">
            <nav class="navigation">
                @php
                    $currentRoute = request()->route() ? request()->route()->getName() : null;
                    $menuItems = [
                        [
                            'label' => 'Beranda',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 11.5 12 4l9 7.5" /><path stroke-linecap="round" stroke-linejoin="round" d="M5 10v9h4v-5h6v5h4v-9" /></svg>',
                            'route' => 'admin.dashboard',
                            'patterns' => ['admin.dashboard'],
                        ],
                        [
                            'label' => 'Manajemen Jadwal',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M8 3v2m8-2v2" /><rect width="18" height="16" x="3" y="5" rx="2" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" /></svg>',
                            'route' => 'admin.schedules.index',
                            'patterns' => ['admin.schedules.*', 'admin.schedule.*'],
                        ],
                        [
                            'label' => 'Manajemen Siswa',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M7 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm10 0a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2 20a4.5 4.5 0 0 1 4.5-4.5H9a4.5 4.5 0 0 1 4.5 4.5v1H2zm9.5 1v-1A4.5 4.5 0 0 1 16 15.5h2.5A4.5 4.5 0 0 1 23 20v1z" /></svg>',
                            'route' => 'admin.students.index',
                            'patterns' => ['admin.students.*'],
                        ],
                        [
                            'label' => 'Manajemen Tentor',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 0-6 0 3 3 0 0 0 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21a4.5 4.5 0 0 0-9 0Zm0 0H21a2 2 0 0 0 2-2v-1a8 8 0 0 0-8-8h-6a8 8 0 0 0-8 8v1a2 2 0 0 0 2 2h1.5" /></svg>',
                            'route' => 'admin.tentors.index',
                            'patterns' => ['admin.tentors.*'],
                        ],
                        [
                            'label' => 'Manajemen Paket',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7 12 3l9 4v10l-9 4-9-4z" /><path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 4 9-4" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 11v10" /></svg>',
                            'route' => 'admin.packages.index',
                            'patterns' => ['admin.packages.*'],
                        ],

                        [
                            'label' => 'Manajemen Keuangan',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h14a2 2 0 0 1 2 2v8a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V9a2 2 0 0 1 2-2z" /><path stroke-linecap="round" stroke-linejoin="round" d="M18 11h3v4h-3a2 2 0 0 1 0-4z" /></svg>',
                            'route' => 'admin.finance.index',
                            'patterns' => ['admin.finance.*'],
                        ],
                        [
                            'label' => 'Manajemen Konten',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>',
                            'route' => 'admin.content.index',
                            'patterns' => ['admin.content.*'],
                        ],
                    ];
                    $adminSummaryAvatar = \App\Support\ProfileAvatar::forUser(Auth::user());
                @endphp
                @foreach ($menuItems as $item)
                    @php
                        $isActive = false;
                        foreach ($item['patterns'] as $pattern) {
                            if ($currentRoute && \Illuminate\Support\Str::is($pattern, $currentRoute)) {
                                $isActive = true;
                                break;
                            }
                        }
                    @endphp
                    <a href="{{ route($item['route']) }}" class="nav-link" data-active="{{ $isActive ? 'true' : 'false' }}">
                        <span class="nav-icon" aria-hidden="true">{!! $item['icon'] !!}</span>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
            <div class="nav-footer">
                <a class="profile-summary" href="{{ route('admin.account.edit') }}" title="Kelola profil admin">
                    <img src="{{ $adminSummaryAvatar }}" alt="Foto admin" />
                    <div>
                        <strong>{{ auth()->user()->name ?? 'Admin MayClass' }}</strong>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="logout-btn">
                    @csrf
                    <button type="submit" title="Keluar dari dashboard">
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>
        <div class="main-area">
            <main>
                <div class="page-wrapper">
                    <div class="page-content">
                        @if (session('status'))
                            <div class="flash-message">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="flash-message">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="flash-message" style="background: #fee2e2; color: #b91c1c; border-color: #fecaca;">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('alert'))
                            <div class="flash-message" style="background: #fff7ed; color: #c2410c; border-color: #ffedd5;">
                                {{ session('alert') }}
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- Bootstrap 4 JS & Dependencies --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>