<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
    
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard.index');
            } elseif ($user->role === 'owner') {
                return redirect()->route('owner.dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard.index'); // misalnya untuk user biasa
            }
        }
    
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
    

    public function logout()
    {if (Auth::check()) {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return view('/login')->with('message', 'Logout Successful!');
    }
    return redirect('/login')->with('message', 'Already logged out.');
    }
}
