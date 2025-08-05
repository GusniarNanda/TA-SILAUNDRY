@extends('layouts.dashboard')

@section('judul', 'Chat dengan Admin')

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
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">💬 Chat dengan Admin</h5>
            </div>

            <div class="chat-box mb-0">
                @forelse ($messages as $message)
                    <div class="chat-message {{ $message->from_user_id == Auth::id() ? 'right' : '' }}">
                        @if ($message->from_user_id !== Auth::id())
                            <div class="chat-avatar">
                                {{ strtoupper(substr('AD', 0, 2)) }}
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

            <div class="card-footer">
                <form action="{{ route('user.chat.send') }}" method="POST">
                    @csrf
                    <div class="input-group shadow-sm">
                        <input type="text" name="message" class="form-control" placeholder="Ketik pesan..." required>
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
