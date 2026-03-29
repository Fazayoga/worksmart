<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login - WorkSmart</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Public Sans', sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            margin: 0;
        }

        .logo-container {
            text-align: center;
            margin-top: 2rem;
            margin-bottom: 4rem;
        }

        .logo-img {
            width: 100px;
            margin-bottom: 0.5rem;
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: 800;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-container {
            width: 100%;
            max-width: 350px;
        }

        .input-group-modern {
            background-color: #f2f4f7;
            border-radius: 12px;
            margin-bottom: 1.25rem;
            padding: 5px 15px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .input-group-modern:focus-within {
            background-color: #fff;
            box-shadow: 0 0 0 2px #00a896;
        }

        .input-group-modern i {
            color: #a1acb8;
            font-size: 1.25rem;
            margin-right: 10px;
        }

        .input-group-modern input {
            background: transparent;
            border: none;
            padding: 12px 0;
            width: 100%;
            font-size: 1rem;
            color: #333;
            outline: none !important;
        }

        .input-group-modern input::placeholder {
            color: #a1acb8;
            font-weight: 500;
        }

        .btn-masuk {
            background-color: #00a896;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 1rem;
            font-size: 1rem;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(0, 168, 150, 0.2);
        }

        .form-links {
            display: flex;
            justify-content: flex-end;
            margin-top: 0.75rem;
        }

        .link-forgot {
            color: #00a896;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .link-register {
            margin-top: 4rem;
            text-align: center;
            font-size: 0.9rem;
            color: #888;
        }

        .link-register a {
            color: #ff6b35;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="{{ asset('assets/img/favicon/logo.ico') }}" alt="Logo" class="logo-img">
        <div class="brand-name">WorkSmart</div>
    </div>

    <div class="form-container">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group-modern">
                <i class='bx bx-envelope'></i>
                <input type="email" name="email" placeholder="Email" required autofocus>
            </div>
            
            <div class="input-group-modern">
                <i class='bx bx-lock-alt'></i>
                <input type="password" name="password" placeholder="Password" id="passwordInput" required>
                <button type="button" class="btn border-0 p-0 ms-auto" onclick="togglePassword(event)">
                    <i class='bx bx-hide' id="toggleIcon" style="font-size: 1.5rem; color: #a1acb8;"></i>
                </button>
            </div>

            <div class="form-links">
                <a href="{{ route('password.request') }}" class="link-forgot">Lupa Password</a>
            </div>

            <button type="submit" class="btn-masuk">MASUK</button>
        </form>

        <div class="link-register">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
    </div>

    <script>
        function togglePassword(event) {
            event.preventDefault();
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bx-hide', 'bx-show');
            } else {
                input.type = 'password';
                icon.classList.replace('bx-show', 'bx-hide');
            }
        }
    </script>
</body>
</html>
