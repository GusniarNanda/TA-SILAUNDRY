@extends('layouts.app')

@section('content')
    <h1>Edit Bukti Pembayaran</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.transaksi.updatePembayaran', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="bukti_pembayaran">Upload Bukti Pembayaran:</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required>
            @error('bukti_pembayaran')
                <div>{{ $message }}</div>
            @enderror
        </div>

        @if($pesanan->bukti_pembayaran)
            <div>
                <p>Bukti pembayaran saat ini:</p>
                <img src="{{ asset('uploads/bukti_pembayaran/' . $pesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran" width="200">
            </div>
        @endif

        <button type="submit">Upload</button>
    </form>
@endsection
