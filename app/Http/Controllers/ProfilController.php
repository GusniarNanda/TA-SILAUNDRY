<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ProfilController extends Controller
{
    public function edit()
    {
        return view('user.profil.edit', ['user'=>auth()->user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:255',
        ]);
    
        $user = auth()->user();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->no_telepon = $request->no_telepon;
        $user->save();        
    
        return redirect()->route('user.dashboard.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
