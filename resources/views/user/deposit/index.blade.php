@extends('layouts.dashboard')

@section('judul', 'Daftar Deposit')
@section('subjudul', 'Data Deposit Laundry')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Daftar Deposit</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="text-end mb-3">
                    <a href="{{ route('user.deposit.create') }}" class="btn btn-success shadow-sm">
                        <i class="fas fa-plus"></i> Deposit Sekarang
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="font-size: 14px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Metode Pembayaran</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Bukti Transfer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deposits as $deposit)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $deposit->metode_pembayaran }}</td>
                                    <td class="text-end">
                                        Rp {{ number_format($deposit->nominal ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($deposit->status === 'Menunggu Konfirmasi')
                                            <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                                        @elseif ($deposit->status === 'Diterima')
                                            <span class="badge bg-secondary">Diterima</span>
                                        @elseif ($deposit->status === 'Ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                            @if ($deposit->alasan_penolakan)
                                                <br><small class="text-muted">Alasan:
                                                    {{ $deposit->alasan_penolakan }}</small>
                                            @else
                                                <br><small class="text-muted">Ditolak karena melebihi batas waktu</small>
                                            @endif
                                        @else
                                            <span class="badge bg-success">{{ $deposit->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($deposit->created_at)->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ asset('assets/images/' . $deposit->bukti) }}" target="_blank">
                                            <img src="{{ asset('assets/images/' . $deposit->bukti) }}" alt="Bukti"
                                                width="80" class="img-thumbnail">
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Belum Pernah Deposit.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
