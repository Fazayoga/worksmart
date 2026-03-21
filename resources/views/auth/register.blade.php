<!doctype html>

<html lang="en" class="layout-wide customizer-hide" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register | WorkSmart</title>

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

        <h1 class="auth-title">Daftar sekarang! 🚀</h1>
        <p class="auth-subtitle">Gratis 15 hari fitur lengkap. Pendaftaran hanya dilakukan oleh owner / HRD /
            administrator</p>

        <form id="formAuthentication" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="company_name" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" id="company_name" name="company_name"
                    placeholder="Masukkan nama perusahaan" autofocus />
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="full_name" name="full_name"
                    placeholder="Masukkan nama lengkap" />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="Masukkan alamat email" />
            </div>
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="phone" class="form-label">No Telp</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        placeholder="No. Telepon" />
                </div>
                <div class="col-md-6">
                    <label for="mobile" class="form-label">No Hp/Wa</label>
                    <input type="text" class="form-control" id="mobile" name="mobile"
                        placeholder="No. HP atau WhatsApp" />
                </div>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Kota</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Masukkan kota" />
            </div>
            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />

                        <span class="input-group-text toggle-password" data-target="password" style="cursor:pointer;">
                            <i class="icon-base bx bx-hide"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="password_confirmation">Ulang Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password_confirmation" class="form-control"
                            name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />

                        <span class="input-group-text toggle-password" data-target="password_confirmation"
                            style="cursor:pointer;">
                            <i class="icon-base bx bx-hide"></i>
                        </span>
                    </div>
                </div>
            </div>

            <button class="btn btn-auth" type="submit">Daftar Sekarang</button>
        </form>

        <div class="auth-footer">
            <span>Already have an account?</span>
            <a href="{{ url('login') }}" class="auth-link">
                Sign in instead
            </a>
        </div>
    </div>

    <!-- / Content -->
    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.querySelectorAll(".toggle-password").forEach(function(button) {

            button.addEventListener("click", function() {

                const target = document.getElementById(this.getAttribute("data-target"));
                const icon = this.querySelector("i");

                if (target.type === "password") {
                    target.type = "text";
                    icon.classList.remove("bx-hide");
                    icon.classList.add("bx-show");
                } else {
                    target.type = "password";
                    icon.classList.remove("bx-show");
                    icon.classList.add("bx-hide");
                }

            });

        });
    </script>
</body>

</html>
