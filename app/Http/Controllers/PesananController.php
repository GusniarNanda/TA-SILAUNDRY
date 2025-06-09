<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\KategoriPakaian;
use App\Models\Layanan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // Menampilkan form pesanan untuk user
    public function create()
    { 
        $kategoriPakaians = KategoriPakaian::all();
        $layanans = Layanan::all();
        
        return view('user.pesanan.create', compact('kategoriPakaians', 'layanans'));
    }

    // Menyimpan data pesanan dari user
    public function UserStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kategori_pakaian_id' => 'required|integer|exists:kategori_pakaians,id',
            'layanan_id' => 'required|integer|exists:layanan,id',
            'waktu_jemput' => 'required|date',
            'catatan' => 'nullable|string',
        ]);
    
        Pesanan::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kategori_pakaian_id' => $request->kategori_pakaian_id,
            'layanan_id' => $request->layanan_id,
            'waktu_jemput' => $request->waktu_jemput,
            'status' => 'Menunggu', // status default
            'catatan' => $request->catatan,
            'user_id'=> Auth::id(),
        ]);
    
        return redirect()->route('user.pesanan.index')->with('success', 'Pesanan berhasil dikirim!');
    }

    // Fungsi untuk mengubah status jadi selesai dan kurangi saldo user (opsional)
    public function setSelesaiDanKurangiSaldo($id)
    {
        DB::transaction(function () use ($id) {
            $pesanan = Pesanan::with(['user', 'layanan', 'kategoriPakaian'])->findOrFail($id);

            $totalHarga = $pesanan->layanan->harga + $pesanan->kategoriPakaian->harga;

            $user = $pesanan->user;

            if ($user->saldo < $totalHarga) {
                throw new \Exception('Saldo user tidak cukup.');
            }

            $user->saldo -= $totalHarga;
            $user->save();

            $pesanan->status = 'Selesai';
            $pesanan->save();
        });

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan selesai dan saldo user berhasil dikurangi.');
    }

    // Form edit bukti pembayaran user
    public function editPembayaran($id)
    {
        $pesanan = Pesanan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.transaksi.edit', compact('pesanan'));
    }

    // Update bukti pembayaran user
    public function updatePembayaran(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pesanan = Pesanan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bukti_pembayaran'), $filename);

            if ($pesanan->bukti_pembayaran && file_exists(public_path('uploads/bukti_pembayaran/' . $pesanan->bukti_pembayaran))) {
                unlink(public_path('uploads/bukti_pembayaran/' . $pesanan->bukti_pembayaran));
            }

            $pesanan->bukti_pembayaran = $filename;
            $pesanan->status_pembayaran = 'Menunggu Konfirmasi';
            $pesanan->save();

            return redirect()->route('user.transaksi.index')->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return redirect()->back()->with('error', 'Gagal mengupload bukti pembayaran.');
    }

    // Tampilkan transaksi user
    public function userTransaksiIndex()
    {
        $userId = Auth::id();

        $transaksis = Transaksi::whereHas('pesanan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['pesanan.kategoriPakaian', 'pesanan.layanan'])->get();

        return view('user.transaksi.index', compact('transaksis'));
    }

    // Form tambah pesanan di admin
    public function adminCreate()
    {
        $kategoriPakaians = KategoriPakaian::all();
        $layanans = Layanan::all();

        return view('admin.pesanan.create', compact('kategoriPakaians', 'layanans'));
    }

    // Daftar pesanan untuk admin
    public function adminIndex()
    {
        $pesanans = Pesanan::with(['kategoriPakaian', 'layanan', 'user'])->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

    // Form edit pesanan admin
    public function adminEdit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $kategoriPakaians = KategoriPakaian::all();
        $layanans = Layanan::all();

        return view('admin.pesanan.edit', compact('pesanan', 'kategoriPakaians', 'layanans'));
    }

    // Update pesanan admin dengan pengecekan saldo saat status jadi Selesai
    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kategori_pakaian_id' => 'required|integer|exists:kategori_pakaians,id',
            'layanan_id' => 'required|integer|exists:layanan,id',
            'waktu_jemput' => 'required|date',
            'catatan' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $pesanan = Pesanan::with(['user', 'layanan', 'kategoriPakaian'])->findOrFail($id);

        $statusSebelumnya = $pesanan->status;
        $statusBaru = $request->status;

        if ($statusSebelumnya !== 'Selesai' && $statusBaru === 'Selesai') {
            $totalHarga = $pesanan->layanan->harga + $pesanan->kategoriPakaian->harga;
            $user = $pesanan->user;

            if ($user->saldo < $totalHarga) {
                return redirect()->back()->with('error', 'Saldo user tidak cukup untuk menyelesaikan pesanan.');
            }

            $user->saldo -= $totalHarga;
            $user->save();
        }

        $pesanan->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kategori_pakaian_id' => $request->kategori_pakaian_id,
            'layanan_id' => $request->layanan_id,
            'waktu_jemput' => $request->waktu_jemput,
            'catatan' => $request->catatan,
            'status' => $statusBaru,
        ]);

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil diperbarui!');
    }

    // Simpan pesanan dari admin
    public function adminStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kategori_pakaian_id' => 'required|exists:kategori_pakaians,id',
            'layanan_id' => 'required|exists:layanan,id',
            'waktu_jemput' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        Pesanan::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kategori_pakaian_id' => $request->kategori_pakaian_id,
            'layanan_id' => $request->layanan_id,
            'waktu_jemput' => $request->waktu_jemput,
            'status' => 'Menunggu',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    // Hapus pesanan admin
    public function adminDestroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }

    // Acc pesanan dan buat transaksi baru
    public function adminAcc($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $existingTransaksi = Transaksi::where('pesanan_id', $pesanan->id)->first();
        if ($existingTransaksi) {
            return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan sudah pernah di-Acc.');
        }

        Transaksi::create([
            'pesanan_id' => $pesanan->id,
            'berat' => 0,
            'total_bayar' => 0,
            'tanggal_bayar' => Carbon::now(),
            'status_pembayaran' => 'Belum Lunas',
        ]);

        $pesanan->status = 'Diterima';
        $pesanan->save();

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil di-Acc.');
    }
}
