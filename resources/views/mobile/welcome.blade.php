<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Welcome - WorkSmart</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Public Sans', sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            margin: 0;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 5rem;
        }

        .logo-img {
            width: 120px;
            margin-bottom: 1rem;
        }

        .brand-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-container {
            width: 100%;
            max-width: 320px;
        }

        .btn-masuk {
            background-color: #00a896;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            margin-bottom: 1rem;
            font-size: 1rem;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(0, 168, 150, 0.2);
        }

        .btn-daftar {
            background-color: #ff6b35;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            font-size: 1rem;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(255, 107, 53, 0.2);
        }

        .footer-text {
            position: fixed;
            bottom: 2rem;
            text-align: center;
            font-size: 0.8rem;
            color: #888;
            padding: 0 2rem;
            line-height: 1.5;
        }

        .footer-link {
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

    <div class="btn-container text-center">
        <a href="{{ route('mobile.login') }}" style="text-decoration: none;">
            <button class="btn-masuk">MASUK</button>
        </a>
    </div>

    <div class="footer-text">
        Untuk mendaftar sebagai perusahaan silahkan kunjungi website WorkSmart.<br>
        <a href="https://worksmart.co.id" class="footer-link">www.worksmart.co.id</a>
    </div>
</body>

</html>
