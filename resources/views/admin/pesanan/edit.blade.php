@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Edit Pesanan</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control"
                    value="{{ old('nama', $pesanan->nama) }}" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" id="no_hp" name="no_hp" class="form-control"
                    value="{{ old('no_hp', $pesanan->no_hp) }}" required>
                @error('no_hp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control"
                    value="{{ old('alamat', $pesanan->alamat) }}" required>
                @error('alamat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <label for="kategori_pakaian">Pilih Kategori</label>
            <select id="kategori_pakaian" name="kategori_pakaian" class="form-select" required>
                <option value="" disabled>-- Pilih Kategori --</option>
                <option value="1" {{ old('kategori_pakaian', $pesanan->kategori_pakaian) == 1 ? 'selected' : '' }}>
                    Kiloan</option>
                <option value="2" {{ old('kategori_pakaian', $pesanan->kategori_pakaian) == 2 ? 'selected' : '' }}>
                    Pakaian Khusus</option>
                <option value="3" {{ old('kategori_pakaian', $pesanan->kategori_pakaian) == 3 ? 'selected' : '' }}>
                    Lain-lain</option>
            </select>


            <!-- Jenis Layanan -->
            <label for="jenis_layanan">Pilih Layanan</label>
            <select id="jenis_layanan" name="jenis_layanan" class="form-select" required>
                <option value="" disabled>-- Pilih Layanan --</option>
                <option value="1" {{ old('jenis_layanan', $pesanan->jenis_layanan) == 1 ? 'selected' : '' }}>Cuci
                    Ekspress - 12 Jam</option>
                <option value="2" {{ old('jenis_layanan', $pesanan->jenis_layanan) == 2 ? 'selected' : '' }}>Cuci
                    Setrika Ekspress - 12 Jam</option>
                <option value="3" {{ old('jenis_layanan', $pesanan->jenis_layanan) == 3 ? 'selected' : '' }}>Cuci
                    Setrika - 2 Hari</option>
                <option value="4" {{ old('jenis_layanan', $pesanan->jenis_layanan) == 4 ? 'selected' : '' }}>Cuci Saja
                    - 1 Hari</option>
                <option value="5" {{ old('jenis_layanan', $pesanan->jenis_layanan) == 5 ? 'selected' : '' }}>Setrika
                    Saja - 2 Hari</option>
            </select>


            <div class="form-group">
                <label for="tanggal_jam">Tanggal / Jam Penjemputan</label>
                <input type="datetime-local" id="waktu_jemput" name="waktu_jemput" class="form-control"
                    value="{{ old('waktu_jemput', \Carbon\Carbon::parse($pesanan->waktu_jemput)->format('Y-m-d\TH:i')) }}"
                    required>
                @error('waktu_jemput')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="Menunggu" {{ old('status', $pesanan->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu
                    </option>
                    <option value="Diproses" {{ old('status', $pesanan->status) == 'Diproses' ? 'selected' : '' }}>Diproses
                    </option>
                    <option value="Selesai" {{ old('status', $pesanan->status) == 'Selesai' ? 'selected' : '' }}>Selesai
                    </option>
                    <option value="Dibatalkan" {{ old('status', $pesanan->status) == 'Dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea id="catatan" name="catatan" class="form-control">{{ old('catatan', $pesanan->catatan) }}</textarea>
                @error('catatan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Pesanan</button>
            <a href="{{ route('admin.pesanan.index') }}" class="btn btn-danger">Kembali</a>
        </form>
    </div>
@endsection
