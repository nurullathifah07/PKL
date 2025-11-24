<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Login/Auth')</title>

    <link href="{{ asset('assets/img/logo BPS.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        /* Mengganti Background Body dengan gambar bg.png dan memastikan konten terpusat */
        body {
            background-color: transparent !important;
            /* Pastikan file bg.png ada di folder public/assets/img/ */
            background: url('{{ asset('assets/img/bg.png') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center; /* Pusat Vertikal */
            justify-content: center; /* Pusat Horizontal */
            margin: 0;
        }

        /* Memastikan baris kontainer terpusat */
        .row.justify-content-center {
            width: 100%;
        }

        /* Menyesuaikan lebar card container agar lebih ramping */
        .col-xl-5-custom {
            max-width: 450px;
            width: 100%;
        }

        /* Mengoverride margin vertikal bawaan my-5 karena kita menggunakan flexbox di body */
        .card.my-5 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        /* Opsi: membuat card sedikit transparan */
        .card {
            background-color: rgba(255, 255, 255, 0.95);
        }
    </style>
    </head>

<body>
    <div class="container">
        <div class="row justify-content-center">

            {{-- AREA KHUSUS KONTEN (Formulir Login/Register/Forgot Password) --}}
            @yield('content')

        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
