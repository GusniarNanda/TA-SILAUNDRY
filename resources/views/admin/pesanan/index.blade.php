@extends('layouts.dashboard')

@section('judul', 'Daftar Pesanan')
@section('subjudul', 'Pesanan Laundry')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Daftar Pesanan</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- <div class="text-end mb-3">
                    <a href="{{ route('admin.pesanan.create') }}" class="btn btn-success shadow-sm">
                        <i class="fas fa-plus"></i> Tambah Pesanan
                    </a>
                </div> --}}

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="font-size: 14px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Kategori Pakaian</th>
                                <th>Jenis Layanan</th>
                                <th>Opsi Antar Jemput</th>
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
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $pesanan->user->name }}</td>
                                    <td>{{ $pesanan->user->no_telepon }}</td>
                                    <td>{{ $pesanan->user->alamat }}</td>
                                    <td>{{ $pesanan->kategoriPakaian->nama_kategori ?? '-' }}</td>
                                    <td>{{ $pesanan->layanan->nama_layanan ?? '-' }}</td>
                                    <td>{{ $pesanan->opsi_antar_jemput ?? '-' }}</td>
                                    <td>{{ $pesanan->waktu_jemput ?? '-' }}</td>
                                    <td>{{ $pesanan->waktu_antar ?? '-' }}</td>

                                    <td class="text-center">
                                        @php
                                            $badgeClass = match ($pesanan->status) {
                                                'Diterima' => 'bg-success',
                                                'Diproses' => 'bg-warning text-dark',
                                                'Diantar' => 'bg-info text-dark',
                                                'Selesai' => 'bg-secondary',
                                                default => 'bg-light text-dark',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $pesanan->status }}
                                        </span>
                                    </td>
                                    <td>{{ $pesanan->catatan }}</td>
                                    <td>
                                        <div class="d-flex flex-column" style="gap: 6px;">
                                            <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}"
                                                class="btn btn-warning btn-sm text-white rounded-2 shadow-sm px-3 py-2">
                                                <i class="fas fa-pen me-1"></i> Edit
                                            </a>

                                            <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}"
                                                method="POST" style="width: 100%;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm text-white rounded-2 shadow-sm px-3 py-2 w-100"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>

                                            <a href="{{ route('admin.pesanan.acc', $pesanan->id) }}"
                                                class="btn btn-success btn-sm text-white rounded-2 shadow-sm px-3 py-2">
                                                <i class="fas fa-check me-1"></i> Acc
                                            </a>
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
