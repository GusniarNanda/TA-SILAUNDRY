@extends('layouts.dashboard')

@section('judul', 'Pesan Laundry')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Form Pemesanan Laundry</h3>
            </div>

            <form action="{{ route('user.pesanan.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <!-- Nama -->
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <!-- No HP -->
                    <div class="form-group mb-3">
                        <label for="no_telepon">Nomor HP</label>
                        <textarea name="no_telepon" class="form-control" readonly>{{ old('no_telepon', Auth::user()->no_telepon) }}</textarea>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" readonly>{{ old('alamat', Auth::user()->alamat) }}</textarea>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group mb-3">
                        <label for="kategori_pakaian_id">Kategori Pakaian</label>
                        <select name="kategori_pakaian_id" class="form-control" required>
                            <option value="" disabled {{ old('kategori_pakaian_id') ? '' : 'selected' }}>Pilih
                                Kategori</option>
                            @foreach ($kategoriPakaians as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_pakaian_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Layanan -->
                    <div class="form-group mb-3">
                        <label for="layanan_id">Jenis Layanan</label>
                        <select name="layanan_id" class="form-control" required>
                            <option value="" disabled {{ old('layanan_id') ? '' : 'selected' }}>Pilih Layanan</option>
                            @foreach ($layanans as $layanan)
                                <option value="{{ $layanan->id }}"
                                    {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                    {{ $layanan->nama_layanan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Opsi Antar Jemput -->
                    <div class="form-group mb-3">
                        <label for="opsi_antar_jemput">Opsi Pengiriman</label>
                        <select name="opsi_antar_jemput" class="form-control" onchange="this.form.submit()">
                            <option value=""
                                {{ old('opsi_antar_jemput', request('opsi_antar_jemput')) == null ? 'selected' : '' }}>--
                                Pilih Layanan --</option>
                            <option value="Jemput Saja"
                                {{ old('opsi_antar_jemput', request('opsi_antar_jemput')) == 'Jemput Saja' ? 'selected' : '' }}>
                                Jemput saja</option>
                            <option value="Antar Saja"
                                {{ old('opsi_antar_jemput', request('opsi_antar_jemput')) == 'Antar Saja' ? 'selected' : '' }}>
                                Antar saja</option>
                            <option value="Antar dan Jemput"
                                {{ old('opsi_antar_jemput', request('opsi_antar_jemput')) == 'Antar dan Jemput' ? 'selected' : '' }}>
                                Antar dan Jemput</option>
                        </select>
                        <div class="form-feedback">
                            <ul>
                                <li>
                                    Jemput saja: Pesanan akan dijemput ke lokasi rumah pelanggan.
                                </li>
                                <li>
                                    Antar saja: Pesanan akan dikirim setelah proses laundry selesai.
                                </li>
                                <li>
                                    Antar dan Jemput: Pesanan akan dijemput ke lokasi rumah pelanggan dan dikirim setelah
                                    proses laundry selesai.
                                </li>
                            </ul>
                            @error('opsi_antar_jemput')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        @php
                            $opsi = old('opsi_antar_jemput', request('opsi_antar_jemput'));
                        @endphp

                        @if ($opsi == 'Antar Saja' || $opsi == 'Antar dan Jemput')
                            <div class="form-group mb-3">
                                <label for="waktu_antar">Waktu Antar</label>
                                <input type="datetime-local" name="waktu_antar" class="form-control"
                                    value="{{ old('waktu_antar') }}">
                            </div>
                        @endif

                        @if ($opsi == 'Jemput Saja' || $opsi == 'Antar dan Jemput')
                            <div class="form-group mb-3">
                                <label for="waktu_jemput">Waktu Jemput</label>
                                <input type="datetime-local" name="waktu_jemput" class="form-control"
                                    value="{{ old('waktu_jemput') }}">
                            </div>
                        @endif

                        <!-- Catatan -->
                        <div class="form-group mb-3">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" class="form-control">{{ old('catatan') }}</textarea>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success">Kirim Pesanan</button>
                        <a href="{{ route('user.pesanan.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
            </form>
        </div>
    </div>
@endsection
