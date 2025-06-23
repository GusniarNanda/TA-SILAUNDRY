@extends('layouts.dashboard')

@section('title', 'Chat dengan ' . $user->name)
@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Chat dengan {{ $user->name }}</h5>
            <a href="{{ route('admin.chat.userlist') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="border p-3 mb-3" style="height: 300px; overflow-y: scroll; background-color: #f9f9f9;">
            @foreach ($messages as $message)
                <div class="mb-2 {{ $message->from_user_id == Auth::id() ? 'text-end' : 'text-start' }}">
                    <span class="badge bg-{{ $message->from_user_id == Auth::id() ? 'primary' : 'secondary' }}">
                        {{ $message->message }}
                    </span>
                </div>
            @endforeach
        </div>

        <form action="{{ route('admin.chat.send', ['userId' => $user->id]) }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="Tulis pesan..." required>
                <button class="btn btn-success" type="submit">Kirim</button>
            </div>
        </form>
    </div>
@endsection
