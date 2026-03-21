<!doctype html>

<html lang="en" class="layout-wide customizer-hide" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo: Forgot Password Basic - Pages | Sneat - Bootstrap Dashboard FREE</title>

    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/logo.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body class="auth-page">
    <div class="auth-card">
        <!-- Logo -->
        <div class="auth-logo">
            <div class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="WorkSmart">
                <span class="h4 mb-0 fw-bold text-dark">WorkSmart</span>
            </div>
        </div>
        <!-- /Logo -->

        <h1 class="auth-title">Lupa Password</h1>
        <p class="auth-subtitle">Masukkan email Anda untuk instruksi pengaturan ulang kata sandi</p>

        <form id="formAuthentication" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="Masukkan alamat email" autofocus />
            </div>
            <button class="btn btn-auth" type="submit">Ubah Password</button>
        </form>

        <div class="auth-footer">
            <a href="{{ url('login') }}" class="auth-link">
                Masuk
            </a>
        </div>
    </div>
    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
