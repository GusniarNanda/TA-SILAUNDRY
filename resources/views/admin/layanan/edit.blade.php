@extends('layouts.dashboard')

@section('title', 'Edit Layanan')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Edit Layanan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama Layanan --}}
                    <div class="form-group">
                        <label for="nama_layanan">Nama Layanan</label>
                        <input type="text" name="nama_layanan" id="nama_layanan" class="form-control"
                            value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
                        @error('nama_layanan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Harga Layanan --}}
                    <div class="form-group mt-3">
                        <label for="harga_layanan">Harga Layanan (Rp)</label>
                        <input type="number" name="harga_layanan" id="harga_layanan" class="form-control"
                            value="{{ old('harga_layanan', $layanan->harga_layanan) }}" required min="0">
                        @error('harga_layanan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
