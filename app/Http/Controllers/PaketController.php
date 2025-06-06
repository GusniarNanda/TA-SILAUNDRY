<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Layanan;
use App\Models\KategoriPakaian;
class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = Paket::with('layanan','kategori')->get();
        return view('admin.paket.index', compact('paket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $layanan = Layanan::all();
        $kategori = KategoriPakaian::all();
        return view('admin.paket.create', compact('layanan', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'layanan_id' => 'required|exists:layanan,id',
            'kategori_id' => 'required|exists:kategori_pakaians,id',
            'harga' => 'required|numeric|min:0',
        ]);

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'layanan_id' => $request->layanan_id,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paket = Paket::findOrFail($id);
        $layanan = Layanan::all();
        $kategori = KategoriPakaian::all();
        return view('admin.paket.edit', compact('paket', 'layanan', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'layanan_id' => 'required|exists:layanan,id',
            'kategori_id' => 'required|exists:kategori_pakaians,id',
            'harga' => 'required|numeric|min:0',
        ]);
        $paket = Paket::findOrFail($id);
        $paket->update([
            'nama_paket' => $request->nama_paket,
            'layanan_id' => $request->layanan_id,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
        ]);
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dihapus.');
    }
}
