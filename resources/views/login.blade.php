<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pelangi Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7;
        }

        .login-container {
            min-height: 100vh;
        }

        .login-box {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        .logo-text {
            font-size: 28px;
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="container login-container d-flex align-items-center justify-content-center">
        <div class="col-md-5 login-box">
            <div class="text-center mb-4">
                <div class="logo-text">Pelangi Laundry</div>
                <p class="text-muted">Silakan login untuk melanjutkan</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li style="font-size: 14px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="Masukkan email" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Masukkan kata sandi" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success">Login</button>
                </div>

                <div class="text-center">
                    <small>Belum punya akun? <a href="{{ url('/register') }}">Daftar sekarang</a></small>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
