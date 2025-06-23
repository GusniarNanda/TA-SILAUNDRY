@extends('layouts.dashboard')

@section('judul', 'Chat')
@section('subjudul', 'Daftar Pengguna')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Chat</h4>
            </div>
            <div class="list-group list-group-flush">

                @php
                    $usersWithLastMessage = $users
                        ->map(function ($user) {
                            $lastMessage = \App\Models\Chat::where(function ($query) use ($user) {
                                $query->where('from_user_id', $user->id)->orWhere('to_user_id', $user->id);
                            })
                                ->latest()
                                ->first();

                            $unreadCount = \App\Models\Chat::where('from_user_id', $user->id)
                                ->where('to_user_id', auth()->id())
                                ->where('is_read', false)
                                ->count();

                            return [
                                'user' => $user,
                                'lastMessage' => $lastMessage,
                                'unread' => $unreadCount,
                            ];
                        })
                        ->sortByDesc(fn($item) => optional($item['lastMessage'])->created_at);
                @endphp

                @forelse ($usersWithLastMessage as $data)
                    <a href="{{ route('admin.chat.index', ['userId' => $data['user']->id]) }}"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                        <div class="d-flex flex-column">
                            <strong>{{ $data['user']->name }}</strong>
                            <small class="text-muted">
                                {{ $data['lastMessage'] ? \Illuminate\Support\Str::limit($data['lastMessage']->message, 40) : 'Belum ada pesan.' }}
                            </small>
                        </div>

                        <div class="d-flex align-items-center">
                            @if ($data['unread'] > 0)
                                <span class="badge bg-danger me-2">
                                    {{ $data['unread'] }}
                                </span>
                            @endif
                            <span class="badge bg-primary">Chat</span>
                        </div>
                    </a>
                @empty
                    <div class="p-3 text-muted">Belum ada pengguna.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
