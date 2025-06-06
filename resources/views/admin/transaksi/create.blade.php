@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h2>Tambah Transaksi</h2>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada kesalahan pada input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form untuk memilih pesanan dan berat (GET) --}}
        <form method="GET" action="{{ route('admin.transaksi.create') }}" class="mb-4">
            <div class="mb-3">
                <label for="pesanan_id" class="form-label">Pilih Pesanan</label>
                <select name="pesanan_id" id="pesanan_id" class="form-select" onchange="this.form.submit()" required>
                    <option value="">-- Pilih Pesanan --</option>
                    @foreach ($pesanans as $pesanan)
                        <option value="{{ $pesanan->id }}" {{ request('pesanan_id') == $pesanan->id ? 'selected' : '' }}>
                            #{{ $pesanan->id }} - {{ $pesanan->nama ?? 'Tanpa Nama' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="berat" class="form-label">Berat (kg)</label>
                <input type="number" name="berat" id="berat" class="form-control" value="{{ request('berat') }}"
                    step="0.01" min="0" onchange="this.form.submit()" required>
            </div>
        </form>

        {{-- Form simpan transaksi (POST) --}}
        <form action="{{ route('admin.transaksi.store') }}" method="POST">
            @csrf

            <input type="hidden" name="pesanan_id" value="{{ request('pesanan_id') }}">
            <input type="hidden" name="berat" value="{{ request('berat') }}">

            <div class="mb-3">
                <label for="total_bayar" class="form-label">Total Bayar (Rp)</label>
                <input type="number" name="total_bayar" id="total_bayar" class="form-control"
                    value="{{ $totalBayar ?? '' }}" readonly required step="0.01" min="0">
            </div>

            <div class="mb-3">
                <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                <input type="datetime-local" name="tanggal_bayar" id="tanggal_bayar" class="form-control"
                    value="{{ old('tanggal_bayar') }}" required>
            </div>

            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" class="form-select" required>
                    <option value="Belum Lunas" {{ old('status_pembayaran') == 'Belum Lunas' ? 'selected' : '' }}>Belum
                        Lunas</option>
                    <option value="Lunas" {{ old('status_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
