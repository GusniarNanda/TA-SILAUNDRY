@extends('layouts.dashboard')

@section('judul', 'Daftar Transaksi')
@section('subjudul', 'Data Transaksi Laundry')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Daftar Transaksi</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="text-end mb-3">
                    <a href="{{ route('admin.transaksi.create') }}" class="btn btn-success shadow-sm">
                        <i class="fas fa-plus"></i> Tambah Transaksi
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="font-size: 14px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Berat (kg)</th>
                                <th>Harga Layanan</th>
                                <th>Harga Kategori Pakaian</th>
                                <th>Total Bayar</th>
                                <th>Tanggal Bayar</th>
                                <th>Status Pembayaran</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksis as $transaksi)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $transaksi->pesanan->nama ?? '-' }}</td>
                                    <td class="text-center">{{ $transaksi->berat }} kg</td>
                                    <td class="text-end">
                                        Rp
                                        {{ number_format($transaksi->pesanan->layanan->harga_layanan ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end">
                                        Rp
                                        {{ number_format($transaksi->pesanan->kategoriPakaian->harga_kategori ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end">
                                        Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $transaksi->status_pembayaran == 'Lunas' ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ $transaksi->status_pembayaran }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($transaksi->pesanan->bukti_pembayaran)
                                            <a href="{{ asset('assets/images/' . $transaksi->pesanan->bukti_pembayaran) }}"
                                                target="_blank">
                                                <img src="{{ asset('assets/images/' . $transaksi->pesanan->bukti_pembayaran) }}"
                                                    alt="Bukti" width="80" class="img-thumbnail">
                                            </a>
                                        @else
                                            <span class="text-muted">Belum diupload</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}"
                                            class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Belum ada data transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
