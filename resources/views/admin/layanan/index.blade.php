@extends('layouts.dashboard')

@section('title', 'Data Layanan')

@push('styles')
    <style>
        .table th,
        .table td {
            vertical-align: middle;
            padding: 12px 14px;
            text-align: center;
        }

        .btn-sm {
            font-size: 13px;
            padding: 6px 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .card h4 {
            font-weight: bold;
        }

        .alert {
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Data Layanan</h4>
            <a href="{{ route('admin.layanan.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Layanan
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($layanans as $layanan)
                                <tr>
                                    <td>{{ $layanan->id }}</td>
                                    <td>{{ $layanan->nama_layanan }}</td>
                                    <td>Rp{{ number_format($layanan->harga_layanan, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('admin.layanan.edit', $layanan->id) }}"
                                            class="btn btn-warning btn-sm text-white shadow-sm">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                                onclick="return confirm('Yakin ingin menghapus layanan ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data layanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
