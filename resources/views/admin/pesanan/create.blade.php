@extends('layouts.dashboard')

@section('judul', 'Tambah Pesanan')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Pesanan Laundry</h3>
            </div>
            <form action="{{ route('admin.pesanan.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <!-- Nama -->
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama"
                            required>
                    </div>

                    <!-- No HP -->
                    <div class="form-group mb-3">
                        <label for="no_hp">No HP</label>
                        <input type="text" id="no_hp" name="no_hp" class="form-control"
                            placeholder="Masukkan No HP" required>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Masukkan Alamat" required></textarea>
                        @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kategori Pakaian -->
                    <div class="form-group mb-3">
                        <label for="kategori_pakaian_id">Pilih Kategori</label>
                        <select id="kategori_pakaian_id" name="kategori_pakaian_id" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            @foreach ($kategoriPakaians as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jenis Layanan -->
                    <div class="form-group mb-3">
                        <label for="layanan_id">Pilih Layanan</label>
                        <select id="layanan_id" name="layanan_id" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Layanan --</option>
                            @foreach ($layanans as $layanan)
                                <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Waktu Jemput -->
                    <div class="form-group mb-3">
                        <label for="waktu_jemput">Waktu Jemput</label>
                        <input type="datetime-local" id="waktu_jemput" name="waktu_jemput" class="form-control" required>
                    </div>

                    <!-- Catatan -->
                    <div class="form-group mb-3">
                        <label for="catatan">Catatan</label>
                        <textarea id="catatan" name="catatan" class="form-control" placeholder="Masukkan Catatan"></textarea>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success">Kirim Pesanan</button>
                    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
