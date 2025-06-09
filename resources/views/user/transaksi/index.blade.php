@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h3>Daftar Transaksi Saya</h3>

        @if ($transaksis->isEmpty())
            <p>Belum ada transaksi.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Layanan</th>
                        <th>Berat</th>
                        <th>Total Bayar</th>
                        <th>Status Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->pesanan->nama }}</td>
                            <td>{{ $transaksi->pesanan->kategoriPakaian->nama }}</td>
                            <td>{{ $transaksi->pesanan->layanan->nama }}</td>
                            <td>{{ $transaksi->berat }} kg</td>
                            <td>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                            <td>{{ $transaksi->status_pembayaran }}</td>
                            <td>
                                @if ($transaksi->pesanan->bukti_pembayaran)
                                    <a href="{{ asset('assets/images/' . $transaksi->pesanan->bukti_pembayaran) }}"
                                        target="_blank">Lihat</a>
                                @else
                                    Belum ada
                                @endif
                            </td>
                            <td>
                                @if (!$transaksi->pesanan->bukti_pembayaran)
                                    <a href="{{ route('user.transaksi.edit', $transaksi->pesanan->id) }}"
                                        class="btn btn-sm btn-primary">Upload</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
