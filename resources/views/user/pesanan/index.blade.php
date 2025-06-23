@extends('layouts.dashboard')

@section('judul', 'Dashboard Pengguna')
@section('subjudul', 'Pesanan Saya')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Pesanan Saya</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="text-end mb-3">
                    <a href="{{ route('user.pesanan.create') }}" class="btn btn-success shadow-sm">
                        <i class="fas fa-plus"></i> Pesan Sekarang
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="font-size: 14px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Kategori Pakaian</th>
                                <th>Jenis Layanan</th>
                                <th>Waktu Jemput</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesanan as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->user->no_telepon }}</td>
                                    <td>{{ $item->user->alamat }}</td>
                                    <td>{{ $item->kategoriPakaian->nama_kategori ?? '-' }}</td>
                                    <td>{{ $item->layanan->nama_layanan ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu_jemput)->format('d M Y H:i') }}</td>
                                    <td class="text-center">
                                        @php
                                            $badgeClass = match ($item->status) {
                                                'Diterima' => 'bg-success',
                                                'Diproses' => 'bg-warning text-dark',
                                                'Diantar' => 'bg-info text-dark',
                                                'Selesai' => 'bg-secondary',
                                                default => 'bg-light text-dark',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>{{ $item->catatan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Belum ada pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
