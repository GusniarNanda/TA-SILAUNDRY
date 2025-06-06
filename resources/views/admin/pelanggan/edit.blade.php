@extends('layouts.dashboard')

@section('title', 'Edit Pelanggan')

@section('content')
    <div class="container mt-4">
        <h3>Edit Pelanggan</h3>

        <form action="{{ route('admin.pelanggan.update', $pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control"
                    value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                @error('nama_pelanggan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_telepon">No Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                    value="{{ old('no_telepon', $pelanggan->no_telepon) }}" required>
                @error('no_telepon')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki"
                        {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }}>
                    <label class="form-check-label" for="laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan"
                        {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }}>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
                @error('jenis_kelamin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                @error('alamat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
