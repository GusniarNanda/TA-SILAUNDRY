@extends('layouts.dashboard')

@section('title', 'Tambah Pelanggan')

@section('content')
    <div class="container mt-4">
        <h3>Tambah Pelanggan</h3>

        <form action="{{ route('admin.pelanggan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="no_hp">Telepon</label>
                <input type="text" name="no_telepon" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-laki"
                        required>
                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
