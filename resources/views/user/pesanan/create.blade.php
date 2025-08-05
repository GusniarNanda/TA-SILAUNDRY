@extends('layouts.dashboard')

@section('judul', 'Pesan Laundry')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Form Pemesanan Laundry</h3>
            </div>

            {{-- FORM SUBMIT PESANAN --}}
            <form action="{{ route('user.pesanan.store') }}" method="POST">
                @csrf
                @php
                    $opsi = old('opsi_antar_jemput', request('opsi_antar_jemput'));
                @endphp

                <div class="card-body">

                    <!-- Nama -->
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            value="{{ auth()->user()->name }}" readonly>
                    </div>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- No HP -->
                    <div class="form-group mb-3">
                        <label for="no_telepon">Nomor HP</label>
                        <textarea name="no_telepon" class="form-control" readonly>{{ old('no_telepon', Auth::user()->no_telepon) }}</textarea>
                    </div>
                    @error('no_telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Alamat -->
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" readonly>{{ old('alamat', Auth::user()->alamat) }}</textarea>
                    </div>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

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
                            <option value="" disabled {{ old('layanan_id') ? '' : 'selected' }}>Pilih Layanan
                            </option>
                            @foreach ($layanans as $layanan)
                                <option value="{{ $layanan->id }}"
                                    {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                    {{ $layanan->nama_layanan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- OPSI PENGIRIMAN -->
                    <div class="form-group mb-3">
                        <label for="opsi_antar_jemput">Opsi Pengiriman</label>
                        <select name="opsi_antar_jemput" class="form-control"
                            onchange="window.location.href='{{ route('user.pesanan.create') }}?opsi_antar_jemput=' + this.value">
                            <option value="" {{ $opsi == null ? 'selected' : '' }}>-- Pilih Layanan --</option>
                            <option value="Jemput Saja" {{ $opsi == 'Jemput Saja' ? 'selected' : '' }}>Jemput saja</option>
                            <option value="Antar Saja" {{ $opsi == 'Antar Saja' ? 'selected' : '' }}>Antar saja</option>
                            <option value="Antar dan Jemput" {{ $opsi == 'Antar dan Jemput' ? 'selected' : '' }}>Antar dan
                                Jemput</option>
                        </select>
                        <div class="form-feedback mt-2">
                            <ul class="mb-0">
                                <li>Jemput saja: Pesanan akan dijemput ke lokasi rumah pelanggan.</li>
                                <li>Antar saja: Pesanan akan dikirim setelah proses laundry selesai.</li>
                                <li>Antar dan Jemput: Dijemput dan dikirim kembali setelah selesai.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Waktu antar/jemput -->
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

                    <!-- Metode Pembayaran -->
                    <div class="form-group mb-3">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="Deposit" {{ old('metode_pembayaran') == 'Deposit' ? 'selected' : '' }}>Deposit
                            </option>
                            <option value="COD" {{ old('metode_pembayaran') == 'COD' ? 'selected' : '' }}>COD</option>
                        </select>
                    </div>

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
