@extends('layouts.dashboard')

@section('title', 'Data Kategori Pakaian')

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

        .card h3 {
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
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Kategori Pakaian</h4>
            </div>
            <h3></h3>
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Kategori
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategori as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>Rp{{ number_format($item->harga_kategori, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('admin.kategori.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm text-white shadow-sm">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
