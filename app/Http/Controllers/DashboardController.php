<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard admin
    public function index()
    {
        $totalPemasukkan = Transaksi::sum('total_bayar');
        $totalPelanggan = Pelanggan::count();
        $totalTransaksi = Transaksi::count();

        return view('admin.dashboard.index', compact('totalPemasukkan', 'totalPelanggan', 'totalTransaksi'));
    }

    // Dashboard user
    public function UserDashboard()
    {
        $user = Auth::user();
        // $pesanan = Pesanan::where('user_id', $user->id)
            // ->with('layanan')
            // ->get();
        
        return view('user.dashboard.index', compact('user'));
    }

    // Daftar pesanan user
    public function UserIndex()
    {
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id)->get();

        return view('user.pesanan.index', compact('pesanan'));
    }

    // Tampilkan daftar transaksi user (relasi pesanan)
    public function userTransaksiIndex()
    {
        $userId = Auth::id();

        $transaksis = Transaksi::whereHas('pesanan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['pesanan', 'pesanan.kategoriPakaian', 'pesanan.layanan'])->get();

        return view('user.transaksi.index', compact('transaksis'));
    }

    // Form edit bukti pembayaran
    public function editPembayaran($id)
    {
        $pesanan = Pesanan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.transaksi.edit', compact('pesanan'));
    }

    // Update bukti pembayaran
    public function updatePembayaran(Request $request, $id)
    {
       
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $pesanan = Pesanan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);

            // Hapus file lama jika ada
            if ($pesanan->bukti_pembayaran && file_exists(public_path('assets/images/' . $pesanan->bukti_pembayaran))) {
                unlink(public_path('assets/images/' . $pesanan->bukti_pembayaran));
            }

            $pesanan->bukti_pembayaran = $filename;
            $pesanan->status_pembayaran = 'Menunggu Konfirmasi';
            $pesanan->save();

            return redirect()->route('user.transaksi.index')->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return redirect()->back()->with('error', 'Gagal mengupload bukti pembayaran.');
    }
}
