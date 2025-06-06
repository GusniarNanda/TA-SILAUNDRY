<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data layanan dari database
        $layanans = Layanan::all();
        return view('admin.layanan.index', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_layanan' => 'required|string|max:255',
        'harga_layanan' => 'required|numeric|min:0',
    ]);

    // Simpan data ke database
    Layanan::create([
        'nama_layanan' => $request->nama_layanan,
        'harga_layanan' => $request->harga_layanan,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
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
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi data
    $request->validate([
        'nama_layanan' => 'required|string|max:255',
        'harga_layanan' => 'required|numeric|min:0',
    ]);

    // Cari data layanan
    $layanan = Layanan::findOrFail($id);

    // Update data yang diizinkan
    $layanan->update([
        'nama_layanan' => $request->nama_layanan,
        'harga_layanan' => $request->harga_layanan,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
