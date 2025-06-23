@extends('layouts.main')

@section('title', 'Tata Cara Pemesanan')
@section('about_active', 'active')

@section('content')
    <div class="container my-5">
        <div class="card shadow border-0">
            <div class="card-body">
                <h1 class="card-title h3 fw-bold text-primary mb-4">Panduan Pemesanan & Deposit Laundry</h1>
                <p class="mb-4">Kami adalah layanan laundry terpercaya yang melayani pelanggan sejak 2021. Berikut adalah
                    tata cara pemesanan dan pengisian saldo (deposit) untuk memudahkan Anda menggunakan layanan kami.</p>

                <h4 class="fw-semibold text-dark mb-2">1. Pemesanan Layanan Laundry</h4>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item">🧾 Login ke akun pengguna Anda.</li>
                    <li class="list-group-item">💰 Pastikan saldo Anda mencukupi sebelum memesan.</li>
                    <li class="list-group-item">📋 Isi formulir pemesanan dengan data berikut:
                        <ul class="mt-2">
                            <li>Nama dan nomor HP</li>
                            <li>Alamat penjemputan</li>
                            <li>Jenis layanan dan kategori pakaian</li>
                            <li>Opsi antar atau ambil</li>
                            <li>Tanggal dan jam penjemputan</li>
                            <li>Catatan tambahan (opsional)</li>
                        </ul>
                    </li>
                    <li class="list-group-item">✅ Klik <strong>"Pesan Sekarang"</strong> untuk mengirimkan pesanan.</li>
                </ul>

                <h4 class="fw-semibold text-dark mb-2">2. Proses oleh Karyawan</h4>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item">🚚 Karyawan menjemput cucian sesuai data pesanan.</li>
                    <li class="list-group-item">⚖️ Cucian ditimbang di lokasi laundry.</li>
                    <li class="list-group-item">💸 Sistem menghitung total bayar berdasarkan berat & jenis layanan.</li>
                    <li class="list-group-item">🧾 Saldo pelanggan akan terpotong otomatis.</li>
                    <li class="list-group-item">📦 Cucian diproses & diantar kembali (jika layanan antar dipilih).</li>
                </ul>

                <h4 class="fw-semibold text-dark mb-2">3. Pengisian Saldo (Deposit)</h4>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item">➕ Buka menu <strong>"Deposit Saldo"</strong> di dashboard Anda.</li>
                    <li class="list-group-item">💳 Pilih metode pembayaran (transfer bank/e-wallet).</li>
                    <li class="list-group-item">📎 Isi jumlah saldo dan upload bukti transfer.</li>
                    <li class="list-group-item">🕒 Tunggu verifikasi dari admin.</li>
                    <li class="list-group-item">✅ Setelah disetujui, saldo Anda akan bertambah otomatis.</li>
                </ul>

                <p class="mt-4">❓ Jika Anda mengalami kendala, silakan hubungi kami melalui halaman kontak.</p>
            </div>
        </div>
    </div>
@endsection
