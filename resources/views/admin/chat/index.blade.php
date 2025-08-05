@extends('layouts.dashboard')

@section('title', 'Chat dengan ' . $user->name)
@section('content')
    <style>
        .chat-box {
            height: 450px;
            overflow-y: auto;
            background-color: #f5f5f5;
            border-radius: 10px;
            padding: 15px;
        }

        .chat-message {
            display: flex;
            margin-bottom: 12px;
        }

        .chat-message.right {
            justify-content: flex-end;
        }

        .chat-bubble {
            max-width: 100%;
            padding: 10px 15px;
            border-radius: 15px;
            position: relative;
            font-size: 0.95rem;
            line-height: 1.3;
        }

        .chat-bubble-left {
            background-color: #ffffff;
            border: 1px solid #ddd;
            color: #333;
            border-top-left-radius: 0;
        }

        .chat-bubble-right {
            background-color: #198754;
            color: #fff;
            border-top-right-radius: 0;
        }

        .chat-time {
            font-size: 0.75rem;
            color: #888;
            margin-top: 4px;
        }

        .chat-avatar {
            width: 32px;
            height: 32px;
            background-color: #ccc;
            color: #fff;
            font-size: 0.8rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
        }
    </style>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">💬 Chat dengan {{ $user->name }}</h4>
            <a href="{{ route('admin.chat.userlist') }}" class="btn btn-outline-success btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="chat-box mb-4">
            @forelse ($messages as $message)
                <div class="chat-message {{ $message->from_user_id == Auth::id() ? 'right' : '' }}">
                    @if ($message->from_user_id !== Auth::id())
                        <div class="chat-avatar">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                    <div>
                        <div
                            class="chat-bubble {{ $message->from_user_id == Auth::id() ? 'chat-bubble-right' : 'chat-bubble-left' }}">
                            {{ $message->message }}
                        </div>
                        <div class="chat-time {{ $message->from_user_id == Auth::id() ? 'text-end' : 'text-start' }}">
                            {{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">Belum ada pesan.</div>
            @endforelse
        </div>

        <form action="{{ route('admin.chat.send', ['userId' => $user->id]) }}" method="POST">
            @csrf
            <div class="input-group shadow-sm">
                <input type="text" name="message" class="form-control" placeholder="Tulis pesan..." required>
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
