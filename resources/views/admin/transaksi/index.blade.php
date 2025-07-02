@extends('layouts.dashboard')

@section('title', 'Daftar Transaksi')

@push('styles')
    <style>
        .table th,
        .table td {
            vertical-align: middle;
            padding: 12px 14px;
            text-align: center;
        }

        .badge {
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .card-header h4 {
            font-weight: bold;
        }

        .alert {
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Daftar Transaksi</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Berat (kg)</th>
                                <th>Harga Layanan</th>
                                <th>Harga Kategori Pakaian</th>
                                <th>Total Bayar</th>
                                <th>Tanggal Bayar</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaksi->user->name ?? '-' }}</td>
                                    <td>{{ $transaksi->berat }} kg</td>
                                    <td class="text-end">
                                        Rp{{ number_format($transaksi->pesanan->layanan->harga_layanan ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end">
                                        Rp{{ number_format($transaksi->pesanan->kategoriPakaian->harga_kategori ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end">
                                        Rp{{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $transaksi->status_pembayaran == 'Lunas' ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ $transaksi->status_pembayaran }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Belum ada data transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
