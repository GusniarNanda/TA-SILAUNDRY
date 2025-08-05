@extends('layouts.main')

@section('title', 'Menu Layanan')
@section('menu_active', 'active')

@section('content')
    <div class="container my-5">
        <h1 class="text-center fw-bold mb-4">Menu Layanan</h1>
        <p class="text-center text-muted mb-5">
            Pilih layanan terbaik kami: Cuci Kering, Cuci Setrika, Setrika Saja, Bed Cover, Sepatu, Express, dll.
        </p>

        <div class="row row-cols-1 row-cols-md-3 g-4">

            {{-- Cuci Kering --}}
            <div class="col">
                <div class="card h-100 text-white bg-primary shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Cuci Kering</h5>
                        <p class="card-text">Pakaian dicuci dan dikeringkan tanpa disetrika. Cocok untuk sehari-hari.</p>
                        <span class="badge bg-light text-dark">Rp4.000 / Kg</span>
                    </div>
                </div>
            </div>

            {{-- Cuci Setrika --}}
            <div class="col">
                <div class="card h-100 text-white bg-success shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Cuci Setrika</h5>
                        <p class="card-text">Pakaian dicuci, dikeringkan, dan disetrika. Siap pakai!</p>
                        <span class="badge bg-light text-dark">Rp5.000 / Kg</span>
                    </div>
                </div>
            </div>

            {{-- Setrika Saja --}}
            <div class="col">
                <div class="card h-100 text-dark bg-warning shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Setrika Saja</h5>
                        <p class="card-text">Layanan untuk menyetrika pakaian yang sudah dicuci sendiri.</p>
                        <span class="badge bg-light text-dark">Rp3.000 / Kg</span>
                    </div>
                </div>
            </div>

            {{-- Cuci Bed Cover --}}
            <div class="col">
                <div class="card h-100 text-white bg-danger shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Cuci Bed Cover</h5>
                        <p class="card-text">Pembersihan khusus untuk bed cover, selimut, atau seprei besar.</p>
                        <span class="badge bg-light text-dark">Rp20.000 / pcs</span>
                    </div>
                </div>
            </div>

            {{-- Cuci Wearpack --}}
            <div class="col">
                <div class="card h-100 text-white bg-info shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Cuci Wearpack</h5>
                        <p class="card-text">Pembersihan wearpack sesuai standar agar tetap seperti baru.</p>
                        <span class="badge bg-light text-dark">Rp15.000 / pcs</span>
                    </div>
                </div>
            </div>

            {{-- Layanan Express --}}
            <div class="col">
                <div class="card h-100 text-white bg-secondary shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Layanan Express</h5>
                        <p class="card-text">Proses cepat dalam 24 jam untuk pakaian darurat kamu.</p>
                        <span class="badge bg-light text-dark">Rp8.000 / Kg</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
