@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}" required>
                @error('nama_kategori')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga_kategori">Harga Kategori (Rp)</label>
                <input type="number" name="harga_kategori" id="harga_kategori" class="form-control" value="{{ old('harga_kategori') }}" min="0" required>
                @error('harga_kategori')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
