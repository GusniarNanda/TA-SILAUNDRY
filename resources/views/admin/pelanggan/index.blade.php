@extends('layouts.dashboard')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h3>Data Pelanggan</h3>
            @if (auth()->user()->can('tambah_admin'))
            <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary">+ Tambah Pelanggan</a>
            @endif
           
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggan as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->nama_pelanggan }}</td>
                                <td>{{ $p->no_telepon }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>
                                    <a href="{{ route('admin.pelanggan.edit', $p->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.pelanggan.destroy', $p->id) }}" method="POST"
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
                                <td colspan="6" class="text-center">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
