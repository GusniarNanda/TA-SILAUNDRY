@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h2>Edit Transaksi</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada kesalahan saat input data:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form GET untuk menghitung ulang total bayar --}}
        <form method="GET" action="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="mb-4">
            <div class="row">
                <div class="col-md-5">
                    <label for="pesanan_id" class="form-label">Pilih Pesanan</label>
                    <select name="pesanan_id" id="pesanan_id" class="form-select" required>
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach ($pesanans as $pesanan)
                            <option value="{{ $pesanan->id }}"
                                {{ old('pesanan_id', request('pesanan_id', $transaksi->pesanan_id)) == $pesanan->id ? 'selected' : '' }}>
                                #{{ $pesanan->id }} - {{ $pesanan->nama ?? 'Tanpa Nama' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="berat" class="form-label">Berat (kg)</label>
                    <input type="number" name="berat" id="berat" class="form-control"
                        value="{{ old('berat', request('berat', $transaksi->berat)) }}" step="0.01" min="0"
                        required>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-warning mt-2">Hitung Ulang Total Bayar</button>
                </div>
            </div>
        </form>

        {{-- Form PUT untuk update transaksi --}}
        <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="pesanan_id" value="{{ request('pesanan_id', $transaksi->pesanan_id) }}">
            <input type="hidden" name="berat" value="{{ request('berat', $transaksi->berat) }}">

            <div class="mb-3">
                <label for="total_bayar" class="form-label">Total Bayar (Rp)</label>
                <input type="number" name="total_bayar" id="total_bayar" class="form-control"
                    value="{{ old('total_bayar', $totalBayar) }}" readonly required step="0.01" min="0">
            </div>

            <div class="mb-3">
                <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                <input type="datetime-local" name="tanggal_bayar" id="tanggal_bayar" class="form-control"
                    value="{{ old('tanggal_bayar', \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('Y-m-d\TH:i')) }}"
                    required>
            </div>
{{-- 
            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" class="form-select" required>
                    <option value="Belum Lunas"
                        {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Belum Lunas' ? 'selected' : '' }}>
                        Belum Lunas</option>
                    <option value="Lunas"
                        {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Lunas' ? 'selected' : '' }}>Lunas
                    </option>
                </select>
            </div> --}}

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
