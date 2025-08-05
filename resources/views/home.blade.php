<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="assets/css/tiny-slider.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <title>Pelangi Laundry </title>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="{{ asset('assets/images/pelangi.png') }}" alt=""
                    style="width: 60px; height: 60px;"></span>Pelangi Laundry<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li><a class="nav-link" href="/lokasi">Lokasi Kami</a></li>
                    <li><a class="nav-link" href="/harga">Pricelist</a></li>
                    <li><a class="nav-link" href="/menu">Layanan</a></li>
                    <li><a class="nav-link" href="/about">Panduan</a></li>
                    <li><a class="nav-link" href="/kontak">Kontak</a></li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('login') }}">
                            <img src="{{ asset('assets/images/user.svg') }}" alt="User Icon"
                                style="width: 20px; height: 20px;">
                            <span>Login</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>SILAUNDRY <span clsas="d-block">Pelangi Laundry</span></h1>
                        <p class="mb-4">Siap melayani anda dengan sepenuh hati</p>
                        <p><a href="{{ route('login') }}" class="btn btn-secondary me-2">Pesan Sekarang</a></p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('assets/images/laundry fix.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Layanan Kami.</h2>
                    <p class="mb-4">Kami di Pelangi Laundry menyediakan beberapa layanan yang bisa pelanggan pilih dan
                        yang pasti dengan harga yang terjangkau </p>
                    <p><a href="shop.html" class="btn">Explore</a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="cart.html">
                        <img src="{{ asset('assets/images/product-1.png') }}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Cuci Kering</h3>
                        <strong class="product-price">Rp.4.000</strong>
                        {{-- <span class="icon-cross">
                            <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid">
                        </span> --}}
                    </a>
                </div>
                <!-- End Column 2 -->

                <!-- Start Column 3 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="cart.html">
                        <img src="{{ asset('assets/images/product-2.png') }}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Cuci Setrika</h3>
                        <strong class="product-price">Rp5.000/Kg</strong>

                        {{-- <span class="icon-cross">
                            <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid">
                        </span> --}}
                    </a>
                </div>
                <!-- End Column 3 -->

                <!-- Start Column 4 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="cart.html">
                        <img src="{{ asset('assets/images/product-3.png') }}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Cuci Express</h3>
                        <strong class="product-price">Rp.8.000/Kg</strong>
                        {{-- <span class="icon-cross">
                            <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid">
                        </span> --}}
                    </a>
                </div>
                <!-- End Column 4 -->

            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Mengapa Pelangi Laundry?</h2>
                    <p>Pelangi Laundry ada untuk pelanggan setia kami dan sebagai solusi yang efektif untuk pelanggan
                        yang membutuhkan layanan laundry yang cepat dan bersih dan harga yang terjangkau pastinya</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/truck.svg') }}" alt="Image"
                                        class="imf-fluid">
                                </div>
                                <h3>Bebas Biaya Antar Jemput</h3>
                                <p>Nikmati layanan antar jemput GRATIS untuk setiap pemesanan laundry anda </p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/bag.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Pelayanan Cepat </h3>
                                <p>Kami mengutamakan kecepatan dalam layanan laundry kami dan tetap mengutamakan
                                    kebersihan</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('/assets/images/support.svg') }}" alt="Image"
                                        class="imf-fluid">
                                </div>
                                <h3>Harga Terjangkau</h3>
                                <p>Pelangi Laundry memberikan layanan yang terbaik dan harga yang terjangkau</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/return.svg') }}" alt="Image"
                                        class="imf-fluid">
                                </div>
                                <h3>Hassle Free Returns</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ asset('assets/images/delivery.jpeg') }}" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start Footer Section -->
    <footer class="footer-section">
        <div class="container relative">

            <div class="sofa-img">
                <img src="{{ asset('assets/images/sofa.png') }}" alt="Image" class="img-fluid">
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="subscription-form">
                        <h3 class="d-flex align-items-center">
                            <span class="me-1">
                                <img src="{{ asset('assets/images/envelope-outline.svg') }}" alt="Image"
                                    class="img-fluid">
                            </span>
                            <span>Subscribe to Newsletter</span>
                        </h3>

                        <form action="#" class="row g-3">
                            <div class="col-auto">
                                <input type="text" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">
                                    <span class="fa fa-paper-plane"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap">
                        <a href="#" class="footer-logo">Pelangi Laundry<span>.</span></a>
                    </div>
                    <p class="mb-4">Layanan laundry cepat, bersih, dan ramah di kantong. Gratis antar jemput untuk
                        area tertentu. Kepuasan Anda prioritas kami!</p>

                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                    </div>
                </div>
            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>. All Rights Reserved. &mdash; Developed by Pelangi Laundry
                        </p>
                    </div>

                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Syarat &amp; Ketentuan</a></li>
                            <li><a href="#">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <!-- End Footer Section -->



    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
