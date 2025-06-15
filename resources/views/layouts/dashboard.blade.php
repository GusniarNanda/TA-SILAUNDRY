    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="SDN Bulupayung 04">
        <title>@yield('title')</title>

        <!-- Meta SEO -->
        @stack('meta-seo')

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap"
            rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <!-- Font Awesome CDN -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- AdminLTE CSS -->
        <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
        <!-- Plugin Styles -->
        <link rel="stylesheet"
            href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">

        <!-- Landing Page Assets -->
        <link rel="icon" href="assets/img/logo1.jpg">
        <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="assets/css/main.css" rel="stylesheet">

        @stack('css')

        <style>
            .content {
                margin-left: 250px;
            }

            .main-sidebar {
                background-color: #3374ff;
            }

            .main-sidebar .nav-link,
            .main-sidebar .nav-link:hover {
                color: white !important;
            }

            .main-sidebar .nav-link:hover {
                background-color: #C70039;
            }

            .user-panel {
                background-color: #3374ff;
            }

            .text-sky-blue {
                color: #051629 !important;
            }

            .user-panel .info h {
                color: rgb(14, 1, 1);
                font-size: 1.5rem;
                font-weight: bold;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
        </style>

        @yield('css')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">@yield('judul')</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">@yield('subjudul')</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center align-items-center">
                        <div class="info text-center">
                            <h href="#" class="d-block">laundry </h>
                        </div>
                    </div>

                    <div class="user-panel pb-3 mb-1 d-flex">
                        <div class="info">
                            @auth
                                <a href="#" class="d-block">
                                    <b>Selamat datang,</b><br>
                                    <span class="fs-5 text-sky-blue"><b>{{ Auth::user()->name }}</b></span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="d-block">
                                    <b>Silahkan Login</b>
                                </a>
                            @endauth
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            @if (auth()->user()->role == 'admin')
                                {{-- dashboarad --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>

                                {{-- data pelanggan --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.pelanggan.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-notes-medical"></i>
                                        <p>Pelanggan</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.layanan.index') }}" class="nav-link">
                                        <i class="fas fa-business-time"></i>
                                        <p>Layanan Laundry</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.kategori.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-tshirt"></i>
                                        <p>Kategori Pakaian</p>
                                    </a>
                                </li>
                                {{-- data pesanan --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.pesanan.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>Data Pesanan Laundry</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.transaksi.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>Data Transaksi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.deposit.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-notes-medical"></i>
                                        <p>Deposit Pelanggan</p>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="/" target="_blank" class="nav-link">
                                    <i class="nav-icon fas fa-link"></i>
                                    <p>Lihat Website</p>
                                </a>
                            </li>
                            @if (auth()->check() && auth()->user()->role === 'owner')
                                <li class="nav-item" style="list-style-type: none;">
                                    <a href="{{ route('owner.pelanggan.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Pelanggan</p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->check() && auth()->user()->role === 'user')
                                <li class="nav-item">
                                    <a href="{{ route('user.dashboard.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-shopping-cart"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('user.pesanan.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-shopping-cart"></i>
                                        <p>Pesanan Saya</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.deposit.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-shopping-cart"></i>
                                        <p>Riwayat Deposit</p>
                                    </a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">
                                    <i class="nav-icon fas fa-arrow-left"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content">
                @yield('content')
            </div>
            <footer class="main-footer text-center">
                <strong>Copyright &copy; {{ date('Y') }} <a href="#">by PT Cazh Teknologi
                        Inovasi</a>.</strong>
            </footer>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('lte/plugins/sparklines/sparkline.js') }}"></script>
        <script src="{{ asset('lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


        @stack('js')
    </body>

    </html>
