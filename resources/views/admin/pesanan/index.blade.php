@extends('layouts.dashboard')

@section('title', 'Daftar Pesanan')

@push('styles')
    <style>
        .card-header h4 {
            font-weight: bold;
            margin-bottom: 0;
        }

        .table th,
        .table td {
            vertical-align: middle !important;
            padding: 12px 14px;
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background-color: #f0f8ff;
        }

        .badge {
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 1rem;
        }

        .btn-sm {
            font-size: 13px;
            padding: 6px 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .modal .form-control {
            font-size: 14px;
        }

        .d-flex.flex-column>*+* {
            margin-top: 6px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Daftar Pesanan</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Kategori</th>
                                <th>Layanan</th>
                                <th>Opsi Pengiriman</th>
                                <th>Waktu Jemput</th>
                                <th>Waktu Antar</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanans as $pesanan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pesanan->user->name }}</td>
                                    <td>{{ $pesanan->user->no_telepon }}</td>
                                    <td>{{ $pesanan->user->alamat }}</td>
                                    <td>{{ $pesanan->kategoriPakaian->nama_kategori ?? '-' }}</td>
                                    <td>{{ $pesanan->layanan->nama_layanan ?? '-' }}</td>
                                    <td>{{ $pesanan->opsi_antar_jemput ?? '-' }}</td>
                                    <td>{{ $pesanan->waktu_jemput ?? '-' }}</td>
                                    <td>{{ $pesanan->waktu_antar ?? '-' }}</td>
                                    <td>
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
                                    </td>
                                    <td>{{ $pesanan->catatan }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}"
                                                class="btn btn-warning btn-sm text-white shadow-sm">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                                    onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>

                                            @if ($pesanan->status === 'Menunggu')
                                                <a href="{{ route('admin.pesanan.acc', $pesanan->id) }}"
                                                    class="btn btn-success btn-sm shadow-sm">
                                                    <i class="fas fa-check"></i> Acc
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm shadow-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rejectModal{{ $pesanan->id }}">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>

                                                <!-- Modal Tolak -->
                                                <div class="modal fade" id="rejectModal{{ $pesanan->id }}" tabindex="-1"
                                                    aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="rejectModalLabel">Catatan
                                                                    Penolakan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('admin.pesanan.reject', $pesanan->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="catatan"
                                                                            class="form-label">Catatan</label>
                                                                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">OK</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
