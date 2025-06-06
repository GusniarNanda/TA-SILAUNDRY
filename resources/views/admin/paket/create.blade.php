@extends('layouts.dashboard')

@section('title', 'Tambah Paket')

@section('content')
    <div class="container mt-4">
        <h3>Tambah Paket</h3>

        <form action="{{ route('admin.paket.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_paket">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" class="form-control" required>
                @error('nama_paket')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="layanan_id">Layanan</label>
                <select name="layanan_id" id="layanan_id" class="form-control" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach ($layanan as $layanan)
                        <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                    @endforeach
                </select>
                @error('layanan_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga">Harga (/kg)</label>
                <input type="number" name="harga" id="harga" step="0.01" class="form-control" required>
                @error('harga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.paket.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
