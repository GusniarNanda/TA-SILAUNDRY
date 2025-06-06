<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriPakaian;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriPakaian::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'harga_kategori' => 'required|numeric|min:0',
        ]);
    
        KategoriPakaian::create([
            'nama_kategori' => $request->nama_kategori,
            'harga_kategori' => $request->harga_kategori,
        ]);
    
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori pakaian berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = KategoriPakaian::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
        'harga_kategori' => 'required|numeric|min:0',
    ]);

    $kategori = KategoriPakaian::findOrFail($id);
    $kategori->update([
        'nama_kategori' => $request->nama_kategori,
        'harga_kategori' => $request->harga_kategori,
    ]);

    return redirect()->route('admin.kategori.pakaian.index')->with('success', 'Kategori pakaian berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriPakaian::findOrFail($id);
        $kategori->delete();
        return redirect()->route('admin.kategori.pakaian.index')->with('success', 'Kategori pakaian berhasil dihapus.');
    }
}
