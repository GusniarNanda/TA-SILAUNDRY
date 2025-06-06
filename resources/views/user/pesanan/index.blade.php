@extends('layouts.dashboard')

@section('title', 'Pesanan Saya')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Riwayat Pesanan</h3>

        {{-- Tombol Pesan --}}
        <div class="mb-3 text-end">
            <a href="{{ route('user.pesanan.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Pesan Sekarang
            </a>
        </div>

        {{-- Tabel Riwayat Pesanan --}}
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($pesanan->isEmpty())
                    <p class="text-muted">Belum ada riwayat pesanan.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle" style="font-size: 14px;">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Layanan</th>
                                    <th>Kategori Pakaian</th>
                                    <th>Status</th>
                                    <th>Waktu Jemput</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                        <td>{{ $item->layanan->nama_layanan ?? '-' }}</td>
                                        <td>{{ $item->kategoriPakaian->nama_kategori ?? '-' }}</td>
                                        <td class="text-center">
                                            @php
                                                $status = strtolower($item->status);
                                                $badgeClass = match ($status) {
                                                    'menunggu' => 'bg-warning text-dark',
                                                    'lunas' => 'bg-primary',
                                                    'batal' => 'bg-danger',
                                                    default => 'bg-success'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->waktu_jemput)->format('d M Y H:i') }}</td>
                                        <td>{{ $item->catatan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
