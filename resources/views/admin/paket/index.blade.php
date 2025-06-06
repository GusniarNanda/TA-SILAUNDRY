@extends('layouts.dashboard')

@section('title', 'Data Paket')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h3>Data Paket</h3>
            <a href="{{ route('admin.paket.create') }}" class="btn btn-primary">+ Tambah Paket</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Paket</th>
                            <th>Layanan</th>
                            <th>Kategori</th>
                            <th>Harga (/kg)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($paket as $index => $paket)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $paket->nama_paket }}</td>
                                <td>{{ $paket->layanan->nama_layanan }}</td>
                                <td>{{ $paket->kategori->nama_kategori }}</td>
                                <td>Rp{{ number_format($paket->harga, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.paket.edit', $paket->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.paket.destroy', $paket->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data paket.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
