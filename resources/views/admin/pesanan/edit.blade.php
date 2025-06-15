@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Edit Pesanan</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control"
                    value="{{ old('nama', $pesanan->nama) }}" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- No HP -->
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" id="no_hp" name="no_hp" class="form-control"
                    value="{{ old('no_hp', $pesanan->no_hp) }}" required>
                @error('no_hp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control"
                    value="{{ old('alamat', $pesanan->alamat) }}" required>
                @error('alamat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kategori Pakaian -->
            <div class="form-group">
                <label for="kategori_pakaian_id">Pilih Kategori</label>
                <select id="kategori_pakaian_id" name="kategori_pakaian_id" class="form-control" required>
                    <option value="" disabled>-- Pilih Kategori --</option>
                    @foreach ($kategoriPakaians as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ old('kategori_pakaian_id', $pesanan->kategori_pakaian_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_pakaian_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jenis Layanan -->
            <div class="form-group">
                <label for="layanan_id">Pilih Layanan</label>
                <select id="layanan_id" name="layanan_id" class="form-control" required>
                    <option value="" disabled>-- Pilih Layanan --</option>
                    @foreach ($layanans as $layanan)
                        <option value="{{ $layanan->id }}"
                            {{ old('layanan_id', $pesanan->layanan_id) == $layanan->id ? 'selected' : '' }}>
                            {{ $layanan->nama_layanan }} - {{ $layanan->durasi }}
                        </option>
                    @endforeach
                </select>
                @error('layanan_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Waktu Jemput -->
            <div class="form-group">
                <label for="waktu_jemput">Tanggal / Jam Penjemputan</label>
                <input type="datetime-local" id="waktu_jemput" name="waktu_jemput" class="form-control"
                    value="{{ old('waktu_jemput', \Carbon\Carbon::parse($pesanan->waktu_jemput)->format('Y-m-d\TH:i')) }}"
                    required>
                @error('waktu_jemput')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

                <!-- Berat Cucian (Hanya untuk Admin) -->
            <div class="form-group">
                <label for="berat">Berat Cucian (kg)</label>
                <input type="number" id="berat" name="berat" class="form-control" step="0.1"
                    value="{{ old('berat', $pesanan->berat) }}" required>
                @error('berat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">
                    Status
                    @php
                        $badgeClass = match ($pesanan->status) {
                            'Diterima' => 'bg-success',
                            'Diproses' => 'bg-warning text-dark',
                            'Diantar' => 'bg-info text-dark',
                            'Selesai' => 'bg-secondary',
                            default => 'bg-light text-dark',
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ $pesanan->status }}</span>
                </label>
                <select id="status" name="status" class="form-control" required>
                    <option value="Diterima" {{ old('status', $pesanan->status) == 'Diterima' ? 'selected' : '' }}>Diterima
                    </option>
                    <option value="Diproses" {{ old('status', $pesanan->status) == 'Diproses' ? 'selected' : '' }}>Diproses
                    </option>
                    <option value="Diantar" {{ old('status', $pesanan->status) == 'Diantar' ? 'selected' : '' }}>Diantar
                    </option>
                    <option value="Selesai" {{ old('status', $pesanan->status) == 'Selesai' ? 'selected' : '' }}>Selesai
                    </option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Catatan -->
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
