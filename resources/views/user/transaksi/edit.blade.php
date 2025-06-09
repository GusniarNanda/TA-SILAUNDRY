@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Bukti Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('user.transaksi.update', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                    <input class="form-control @error('bukti_pembayaran') is-invalid @enderror" type="file" id="bukti_pembayaran" name="bukti_pembayaran" required>
                    @error('bukti_pembayaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if($pesanan->bukti_pembayaran)
                    <div class="mb-3">
                        <label class="form-label">Bukti Pembayaran Saat Ini:</label>
                        <div>
                            <img src="{{ asset('uploads/bukti_pembayaran/' . $pesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-thumbnail" style="max-width: 300px;">
                        </div>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Upload</button>
                <a href="{{ route('user.transaksi.index') }}" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
