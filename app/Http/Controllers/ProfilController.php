<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class ProfilController extends Controller
{
    public function edit()
    {
        return view('user.profil.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:255',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $user = Auth::user();
        $laundryLat = -7.717554;
        $laundryLon = 109.005774;
        
        $userLat = $request->lat;
        $userLon = $request->lon;
        
        $distance = haversineDistance($laundryLat, $laundryLon, $userLat, $userLon);
       
        if ($distance > 5) {
            return back()->with('error', 'Alamat di luar jangkauan layanan (lebih dari 5 km)');
        }
    
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->no_telepon = $request->no_telepon;
        $user->latitude = $request->lat;
        $user->longitude = $request->lon;
        $user->save();

        return redirect()->route('user.profil.edit')->with('success', 'Profil berhasil diperbarui.');
    }

}

