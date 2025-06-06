@extends('layouts.dashboard')

@section('title', 'Data Layanan')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Data Layanan</h4>
            <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">+ Tambah Layanan</a>
        </div>

        <table class="table table-bordered">
            <thead class="thead-light">
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
                            <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus layanan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data layanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
