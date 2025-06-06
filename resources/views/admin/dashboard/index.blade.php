@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Dashboard</h3>

        <div class="row">
            <!-- Card Total Pemasukan -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Pemasukan</h5>
                        <p class="card-text h4">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Contoh Card Tambahan -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pelanggan</h5>
                        <p class="card-text h4">{{ $totalPelanggan }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-info mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Transaksi</h5>
                        <p class="card-text h4">{{ $totalTransaksi }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahan konten lain di sini -->
    </div>
@endsection
