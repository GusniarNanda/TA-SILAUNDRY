@extends('layouts.dashboard')

@section('judul', 'Daftar Transaksi')
@section('subjudul', 'Data Transaksi Laundry')

@push('styles')
    <style>
        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header h4 {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .table th,
        .table td {
            vertical-align: middle !important;
            font-size: 14px;
        }

        .btn-sm {
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 8px;
        }

        .badge {
            font-size: 13px;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .badge.bg-success {
            background-color: #28a745;
        }

        .badge.bg-warning {
            background-color: #ffc107;
        }

        .badge.bg-danger {
            background-color: #dc3545;
        }

        .img-thumbnail {
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
        }

        .alert-success {
            border-radius: 8px;
            font-size: 14px;
        }

        .modal .form-select {
            border-radius: 8px;
        }

        .modal-title {
            font-weight: 600;
        }

        .text-muted small {
            font-size: 12px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Daftar Transaksi Deposit</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Metode Pembayaran</th>
                                <th>Nominal</th>
                                <th>Bukti Transfer</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deposits as $deposit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($deposit->user)->name ?? '-' }}</td>
                                    <td>{{ $deposit->metode_pembayaran }}</td>
                                    <td class="text-end">Rp {{ number_format($deposit->nominal ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($deposit->bukti)
                                            <a href="{{ asset('assets/images/' . $deposit->bukti) }}" target="_blank">
                                                <img src="{{ asset('assets/images/' . $deposit->bukti) }}"
                                                    alt="Bukti Transfer" width="80" class="img-thumbnail">
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($deposit->status === 'Menunggu')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif ($deposit->status === 'Disetujui')
                                            <span class="badge bg-success">Diterima</span>
                                        @elseif ($deposit->status === 'Ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                            <div class="mt-1">
                                                <small class="text-muted fst-italic">
                                                    Alasan:
                                                    {{ $deposit->alasan_penolakan ?? 'Otomatis ditolak karena melewati batas waktu pembayaran.' }}
                                                </small>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $deposit->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            @if ($deposit->status === 'Menunggu')
                                                <form action="{{ route('admin.deposit.approve', $deposit->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                                        <i class="fas fa-check me-1"></i> Setujui
                                                    </button>
                                                </form>

                                                <button type="button" class="btn btn-danger btn-sm shadow-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rejectModal{{ $deposit->id }}">
                                                    <i class="fas fa-times me-1"></i> Tolak
                                                </button>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </div>

                                        {{-- Modal Tolak --}}
                                        <div class="modal fade" id="rejectModal{{ $deposit->id }}" tabindex="-1"
                                            aria-labelledby="rejectModalLabel{{ $deposit->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('admin.deposit.reject', $deposit->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="rejectModalLabel{{ $deposit->id }}">Tolak Deposit</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="alasan" class="form-label">Pilih Alasan
                                                                    Penolakan</label>
                                                                <select name="alasan" class="form-select" required>
                                                                    <option value="" selected disabled>-- Pilih Alasan
                                                                        --</option>
                                                                    <option value="Bukti transfer kurang jelas">Bukti
                                                                        transfer kurang jelas</option>
                                                                    <option value="Nominal tidak sesuai">Nominal tidak
                                                                        sesuai</option>
                                                                    <option value="Data transfer tidak ditemukan">Data
                                                                        transfer tidak ditemukan</option>
                                                                    <option value="Rekening tujuan salah">Rekening tujuan
                                                                        salah</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Tolak
                                                                Deposit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Belum ada transaksi deposit.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
