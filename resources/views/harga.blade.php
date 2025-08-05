@extends('layouts.main')

@section('title', 'Kategori Pakaian')
@section('harga_active', 'active')

@section('content')
    <div class="container my-5">
        <h1 class="text-center fw-bold mb-4">Kategori Pakaian</h1>
        <p class="text-center text-muted mb-4">Berikut adalah jenis pakaian yang kami layani lengkap dengan harga:</p>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Kategori 1 -->
            <div class="col">
                <div class="card h-100 shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">Wearpack</h5>
                        <p class="card-text">Pembersihan wearpack untuk kebutuhan kerja industri atau laboratorium.</p>
                        <p class="text-muted mt-2">Rp15.000 / pcs</p>
                    </div>
                </div>
            </div>

            <!-- Kategori 2 -->
            <div class="col">
                <div class="card h-100 shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title text-danger fw-bold">Bed Cover</h5>
                        <p class="card-text">Layanan untuk mencuci bed cover berukuran besar dan berat.</p>
                        <p class="text-muted mt-2">Rp10.000 / pcs</p>
                    </div>
                </div>
            </div>

            <!-- Kategori 3 -->
            <div class="col">
                <div class="card h-100 shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success fw-bold">Seragam</h5>
                        <p class="card-text">Pakaian seragam sekolah, kerja, atau komunitas.</p>
                        <p class="text-muted mt-2">Rp6.000 / Kg</p>
                    </div>
                </div>
            </div>

            <!-- Kategori 4 -->
            <div class="col">
                <div class="card h-100 shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title text-info fw-bold">Gordyn</h5>
                        <p class="card-text">Gordyn rumah yang kotor dan tidak sempat dicuci.</p>
                        <p class="text-muted mt-2">Rp25.000 / pcs</p>
                    </div>
                </div>
            </div>

            <!-- Kategori 5 -->
            <div class="col">
                <div class="card h-100 shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success fw-bold">Kebaya</h5>
                        <p class="card-text">Pembersihan kebaya yang sesuai standar, tetap seperti baru.</p>
                        <p class="text-muted mt-2">Rp18.000 / pcs</p>
                    </div>
                </div>
            </div>

            <!-- Kategori 6 -->
            <div class="col">
                <div class="card h-100 shadow text-center">
                    <div class="card-body">
                        <h5 class="card-title text-info fw-bold">Jas</h5>
                        <p class="card-text">Jas yang tidak terlalu berat dan tidak sempat dicuci.</p>
                        <p class="text-muted mt-2">Rp20.000 / pcs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
