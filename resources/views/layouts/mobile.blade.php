<!doctype html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="{{ asset('assets/') }}"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') | WorkSmart Mobile</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/logo.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- PWA Settings -->
    <link rel="manifest" href="/manifest.json">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="WorkSmart">
    <link rel="apple-touch-icon" href="/assets/img/logo/logo.png">
    <meta name="theme-color" content="#696cff">

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <style>
        body {
            background-color: #f5f5f9;
            padding-bottom: 75px;
        }

        .mobile-header {
            background-color: #696cff;
            /* Theme Primary */
            color: white;
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: white;
            border-top: 1px solid #e7e7ff;
            display: flex;
            justify-content: space-around;
            padding: 0.75rem 0;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        .mobile-bottom-nav a {
            color: #a1acb8;
            text-align: center;
            font-size: 1.25rem;
            flex: 1;
        }

        .mobile-bottom-nav a.active {
            color: #696cff;
        }

        .attendance-card {
            border: none;
            transition: transform 0.1s ease;
            height: 100%;
        }

        .attendance-card:active {
            transform: scale(0.95);
            background-color: #f8f8fb;
        }

        .attendance-icon-wrapper {
            background-color: #f0f0ff;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
        }

        .attendance-icon-wrapper i {
            font-size: 2rem;
            color: #696cff;
        }

        .card-text-small {
            font-size: 0.75rem;
            font-weight: 500;
            color: #566a7f;
        }
    </style>
    @stack('styles')
</head>

<body>
    @yield('content')

    <nav class="mobile-bottom-nav">
        <a href="{{ route('selfie-absen') }}" class="{{ request()->routeIs('selfie-absen') ? 'active' : '' }}">
            <i class='bx bx-alarm'></i>
            @if (request()->routeIs('selfie-absen'))
                <span class="small d-block" style="font-size: 0.65rem;">Absen</span>
            @endif
        </a>
        <a href="{{ route('mobile.ijin') }}" class="{{ request()->routeIs('mobile.ijin') ? 'active' : '' }}">
            <i class='bx bx-calendar'></i>
            @if (request()->routeIs('mobile.ijin'))
                <span class="small d-block" style="font-size: 0.65rem;">Ijin</span>
            @endif
        </a>
        <a href="{{ route('mobile.tugas') }}" class="{{ request()->routeIs('mobile.tugas') ? 'active' : '' }}">
            <i class='bx bx-briefcase-alt-2'></i>
            @if (request()->routeIs('mobile.tugas'))
                <span class="small d-block" style="font-size: 0.65rem;">Tugas</span>
            @endif
        </a>
        <a href="{{ route('mobile.keuangan') }}" class="{{ request()->routeIs('mobile.keuangan') ? 'active' : '' }}">
            <i class='bx bx-spreadsheet'></i>
            @if (request()->routeIs('mobile.keuangan'))
                <span class="small d-block" style="font-size: 0.65rem;">Keuangan</span>
            @endif
        </a>
        <a href="{{ route('mobile.akun') }}" class="{{ request()->routeIs('mobile.akun') ? 'active' : '' }}">
            <i class='bx bx-user'></i>
            @if (request()->routeIs('mobile.akun'))
                <span class="small d-block" style="font-size: 0.65rem;">Akun</span>
            @endif
        </a>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(reg => console.log('SW Registered', reg))
                .catch(err => console.log('SW Error', err));
        }
    </script>
    @stack('scripts')
</body>

</html>
