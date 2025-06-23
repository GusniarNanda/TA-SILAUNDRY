<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Models\Messages;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function index()
{
    $admin = User::where('role', 'admin')->first();
    $messages = Chat::where(function ($query) use ($admin) {
        $query->where('from_user_id', Auth::id())->where('to_user_id', $admin->id)
              ->orWhere('from_user_id', $admin->id)->where('to_user_id', Auth::id());
    })->orderBy('created_at')->get();

    return view('user.chat.index', compact('messages', 'admin'));
}

public function send(Request $request)
{
    $request->validate(['message' => 'required']);
    $admin = User::where('role', 'admin')->first();

    Chat::create([
        'from_user_id' => Auth::id(),
        'to_user_id' => $admin->id,
        'message' => $request->message,
    ]);

    return back();
}

public function adminUserList()
{
    $users = User::where('role', 'user')->get();

    foreach ($users as $user) {
        $user->unread_count = \App\Models\Chat::where('from_user_id', $user->id)
            ->where('to_user_id', auth()->id()) // admin
            ->where('is_read', false)
            ->count();
    }

    return view('admin.chat.userlist', compact('users'));
}

public function adminView($userId)
{
    $user = User::findOrFail($userId);
    $messages = Chat::where(function ($query) use ($user) {
        $query->where('from_user_id', $user->id)->where('to_user_id', Auth::id())
              ->orWhere('from_user_id', Auth::id())->where('to_user_id', $user->id);
    })->orderBy('created_at')->get();
    // Tandai semua pesan dari user ke admin sebagai sudah dibaca
    \App\Models\Chat::where('from_user_id', $user->id)
    ->where('to_user_id', auth()->id())
    ->where('is_read', false)
    ->update(['is_read' => true]);
    return view('admin.chat.index', compact('messages', 'user'));
}

public function adminSend(Request $request, $userId)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    Chat::create([
        'from_user_id' => Auth::id(), // Admin yang login
        'to_user_id' => $userId,      // User yang dituju
        'message' => $request->message,
    ]);

    return redirect()->route('admin.chat.index', ['userId' => $userId]);
}

}