@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@push('styles')
    <style>
        .card-custom {
            border-radius: 16px;
            transition: transform 0.2s ease-in-out;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .text-white-90 {
            color: rgba(255, 255, 255, 0.9);
        }

        @media (max-width: 767.98px) {
            .card-text {
                font-size: 1.3rem;
            }

            .card-title {
                font-size: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4 fw-bold">Dashboard</h3>

        <div class="row g-4">
            <!-- Total Pemasukan -->
            <div class="col-md-4 col-sm-6">
                <div class="card bg-success card-custom text-white shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-white-90">Total Pemasukan</h5>
                        <p class="card-text">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pelanggan -->
            <div class="col-md-4 col-sm-6">
                <div class="card bg-primary card-custom text-white shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-white-90">Jumlah Pelanggan</h5>
                        <p class="card-text">{{ $totalPelanggan }}</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Transaksi -->
            <div class="col-md-4 col-sm-6">
                <div class="card bg-info card-custom text-white shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-white-90">Jumlah Transaksi</h5>
                        <p class="card-text">{{ $totalTransaksi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
