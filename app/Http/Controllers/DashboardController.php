<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
class DashboardController extends Controller
{
    public function index ()
    {
        $totalPemasukkan = Transaksi::sum('total_bayar');
        $totalPelanggan = Pelanggan::count();
        $totalTransaksi = Transaksi::count();
        return view('admin.dashboard.index',compact('totalPemasukkan','totalPelanggan','totalTransaksi'));
    }

    public function UserDashboard()
    {
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id)
                    ->with('layanan') // <-- ini penting agar relasi bisa digunakan di blade
                    ->get();
    
        return view('user.dashboard.index', compact('pesanan'));
    }
    

    public function UserIndex()
    {
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id)->get();
        return view('user.pesanan.index', compact('pesanan'));
    }

    public function UserTransaksi()
    {
        return view('user.transaksi.index');
    }
}
