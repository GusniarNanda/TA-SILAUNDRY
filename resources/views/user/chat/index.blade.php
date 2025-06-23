@extends('layouts.dashboard')

@section('judul', 'Chat dengan Admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Chat dengan Admin</h5>
            </div>

            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                @forelse ($messages as $message)
                    <div class="mb-3">
                        <div class="{{ $message->from_user_id === Auth::id() ? 'text-end' : 'text-start' }}">
                            <div
                                class="d-inline-block p-2 rounded 
                            {{ $message->from_user_id === Auth::id() ? 'bg-success text-white' : 'bg-light' }}">
                                {{ $message->message }}
                            </div>
                            <div class="small text-muted">
                                {{ $message->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Belum ada pesan.</p>
                @endforelse
            </div>

            <div class="card-footer">
                <form action="{{ route('user.chat.send') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Ketik pesan..." required>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
