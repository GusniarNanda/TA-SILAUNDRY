@extends('layouts.dashboard')

@section('judul', 'Pesan Laundry')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Deposit Saldo</h3>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif
            <form action="{{ route('user.deposit.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <ul>
                        <li>
                            Rekening BNI (1234567890) a.n. John Doe
                        </li>
                        <li>
                            Rekening BCA (0987654321) a.n. Jane Doe
                        </li>
                    </ul>

                    <!-- Kategori Pakaian -->
                    <div class="form-group mb-3">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select id="metode_pembayaran" name="metode_pembayaran" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            <option value="transfer"">Transfer</option>
                        </select>
                        @error('metode_pembayaran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nominal">Nominal</label>
                        <input type="number" min="0" id="nominal" name="nominal" class="form-control"
                            placeholder="Masukkan Nominal" required>
                        @error('nominal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bukti" class="form-label">Upload Bukti Pembayaran</label>
                        <input class="form-control @error('bukti') is-invalid @enderror" type="file" id="bukti"
                            name="bukti" required>
                        @error('bukti')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success">Kirim</button>
                        <a href="{{ route('user.deposit.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
            </form>
        </div>
    </div>
@endsection
