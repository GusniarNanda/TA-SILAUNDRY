@extends('layouts.dashboard')

@section('title', 'Edit Kategori')

@section('content')
    <div class="container mt-4">
        <h3>Edit Kategori Pakaian</h3>
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mt-3">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                @error('nama_kategori')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="harga_kategori">Harga Kategori (Rp)</label>
                <input type="number" name="harga_kategori" id="harga_kategori" class="form-control"
                    value="{{ old('harga_kategori', $kategori->harga_kategori) }}" min="0" required>
                @error('harga_kategori')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3">Update</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
@endsection
