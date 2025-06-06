<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\KategoriPakaian;
use App\Models\Layanan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PesananController extends Controller
{
    // Menampilkan form pesanan
    public function create()
    { 
        $kategoriPakaians = KategoriPakaian::all();
        $layanans = Layanan::all();
        
        return view('user.pesanan.create', compact('kategoriPakaians', 'layanans')) ;
    }

    // Menyimpan data pesanan
    public function store(Request $request)
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
            'status' => 'Menunggu', // default status awal
            'catatan' => $request->catatan,
            'user_id'=> Auth::id(), // Menyimpan ID user yang membuat pesanan
        ]);
    
        return redirect()->route('user.dashboard.index')->with('success', 'Pesanan berhasil dikirim!');

    }
    

    public function adminCreate()
    {
        $kategoriPakaians = KategoriPakaian::all();
        $layanans = Layanan::all();
        
        return view('admin.pesanan.create', compact('kategoriPakaians', 'layanans'));
    }

    public function adminIndex()
    {
        // Ambil semua data pesanan untuk ditampilkan di halaman admin
        $pesanans = Pesanan::with(['kategoriPakaian', 'layanan'])->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }   

    public function adminEdit($id)
    {
        // Ambil data pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.pesanan.edit', compact('pesanan'));
    }

    public function adminUpdate(Request $request, $id)
    {
        // Menampilkan data request untuk debugging
        // dd($request->all());
    
        // Validasi data dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kategori_pakaian' => 'required|string',
            'jenis_layanan' => 'required|string',
            'waktu_jemput' => 'required|date',
            'catatan' => 'nullable|string',
        ]);
    
        // Menemukan pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);
    
        // Mengupdate data pesanan menggunakan update
        $pesanan->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kategori_pakaian' => $request->kategori_pakaian,
            'jenis_layanan' => $request->jenis_layanan,
            'waktu_jemput' => $request->waktu_jemput,
            'catatan' => $request->catatan,
        ]);
    
        // Redirect setelah update
        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil diperbarui!');
    }


    public function adminStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kategori_pakaian_id' => 'required|exists:kategori_pakaians,id', // cek id di tabel kategori_pakaians
            'layanan_id' => 'required|exists:layanan,id', // cek id di tabel layanan
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
    
    
    public function adminDestroy($id)
    {
        // Menghapus pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
    
        // Redirect setelah penghapusan
        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }

    public function adminAcc($id)
{
    $pesanan = Pesanan::findOrFail($id);

    // Cek apakah transaksi sudah ada untuk pesanan ini
    $existingTransaksi = Transaksi::where('pesanan_id', $pesanan->id)->first();
    if ($existingTransaksi) {
        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan sudah pernah di-Acc.');
    }

    // Simpan ke tabel transaksi
    Transaksi::create([
        'pesanan_id' => $pesanan->id,
        'berat' => 0, // default
        'total_bayar' => 0, // akan dihitung setelah input berat
        'tanggal_bayar' => Carbon::now(),
        'status_pembayaran' => 'Belum Lunas',
    ]);

    // Update status pesanan
    $pesanan->status = 'Diterima';
    $pesanan->save();

    return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil di-Acc dan masuk ke transaksi.');
}
}
