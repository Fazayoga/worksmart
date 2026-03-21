<!doctype html>

<html lang="en" class="layout-wide customizer-hide" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login | WorkSmart </title>
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

        <h1 class="auth-title">Masuk</h1>
        <p class="auth-subtitle">Kelola pekerjaan Anda dengan lebih mudah di WorkSmart</p>

        <form id="formAuthentication" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="Masukkan alamat email" autofocus />
            </div>
            <div class="mb-4">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />

                    <span class="input-group-text" id="togglePassword">
                        <i class="icon-base bx bx-hide"></i>
                    </span>
                </div>
            </div>

            <button class="btn btn-auth mb-4" type="submit">Masuk</button>
        </form>
        <hr style="color: black">
        <div class="auth-footer d-flex flex-column gap-3">
            <a href="{{ url('register') }}" class="btn-auth-secondary">
                <i class="icon-base bx bx-building"></i>
                Daftar Perusahaan Disini !
            </a>
            <a href="{{ url('forgotPassword') }}" class="btn-auth-secondary">
                <i class="icon-base bx bx-key"></i>
                Lupa Password ?
            </a>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {

            const password = document.getElementById("password");
            const icon = this.querySelector("i");

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("bx-hide");
                icon.classList.add("bx-show");
            } else {
                password.type = "password";
                icon.classList.remove("bx-show");
                icon.classList.add("bx-hide");
            }

        });
    </script>
</body>

</html>
