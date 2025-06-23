<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Pelangi Laundry | @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="/assets/css/tiny-slider.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet" />
</head>

<body>

    <!-- Navbar -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/pelangi.png') }}" alt="Pelangi Laundry"
                    style="width: 60px; height: 60px;" />
                Pelangi Laundry<span>.</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item @yield('home_active')">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item @yield('lokasi_active')">
                        <a class="nav-link" href="{{ url('/lokasi') }}">Lokasi Kami</a>
                    </li>
                    <li class="nav-item @yield('harga_active')">
                        <a class="nav-link" href="{{ url('/harga') }}">Pricelist</a>
                    </li>
                    <li class="nav-item @yield('menu_active')">
                        <a class="nav-link" href="{{ url('/menu') }}">Menu</a>
                    </li>
                    <li class="nav-item @yield('about_active')">
                        <a class="nav-link" href="{{ url('/about') }}">Panduan</a>
                    </li>
                    <li class="nav-item @yield('kontak_active')">
                        <a class="nav-link" href="{{ url('/kontak') }}">Kontak</a>
                    </li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('login') }}">
                            <img src="{{ asset('assets/images/user.svg') }}" alt="User Icon"
                                style="width: 20px; height: 20px;" />
                            <span>Login</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main Content -->
    <main class="container my-5">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/tiny-slider.js"></script>
    <script src="/assets/js/custom.js"></script>
</body>

</html>
