<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['pesanan.layanan', 'pesanan.kategoriPakaian'])
            ->orderBy('tanggal_bayar', 'desc')
            ->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create(Request $request)
    {
        $pesanans = Pesanan::with(['layanan', 'kategoriPakaian'])->get();
        $totalBayar = null;
        $pesananTerpilih = null;
        $berat = $request->berat;

        if ($request->filled(['pesanan_id', 'berat'])) {
            $pesananTerpilih = Pesanan::with(['layanan', 'kategoriPakaian'])->find($request->pesanan_id);
            if ($pesananTerpilih) {
                $hargaLayanan = $pesananTerpilih->layanan->harga_layanan ?? 0;
                $hargaKategori = $pesananTerpilih->kategoriPakaian->harga_kategori ?? 0;
                $totalBayar = ($hargaLayanan + $hargaKategori) * (float) $berat;
            }
        }

        return view('admin.transaksi.create', compact('pesanans', 'totalBayar', 'pesananTerpilih', 'berat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanan,id',
            'berat' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
        ]);

        $pesanan = Pesanan::with(['layanan', 'kategoriPakaian'])->findOrFail($request->pesanan_id);

        $hargaLayanan = $pesanan->layanan->harga_layanan ?? 0;
        $hargaKategori = $pesanan->kategoriPakaian->harga_kategori ?? 0;
        $totalBayar = ($request->berat * $hargaKategori) + $hargaLayanan;

        Transaksi::create([
            'pesanan_id' => $request->pesanan_id,
            'user_id' => $pesanan->user_id,
            'berat' => $request->berat,
            'total_bayar' => $totalBayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id, Request $request)
    {
        $transaksi = Transaksi::with(['pesanan.layanan', 'pesanan.kategoriPakaian'])->findOrFail($id);
        $pesanans = Pesanan::with(['layanan', 'kategoriPakaian'])->get();
        $totalBayar = null;

        if ($request->has('pesanan_id') && $request->has('berat')) {
            $pesanan = Pesanan::with(['layanan', 'kategoriPakaian'])->find($request->pesanan_id);
            if ($pesanan) {
                $hargaLayanan = $pesanan->layanan->harga_layanan ?? 0;
                $hargaKategori = $pesanan->kategoriPakaian->harga_kategori ?? 0;
                $berat = (float) $request->berat;
                $totalBayar = ($berat * $hargaKategori) + $hargaLayanan;
            }
        } else {
            $hargaLayanan = $transaksi->pesanan->layanan->harga_layanan ?? 0;
            $hargaKategori = $transaksi->pesanan->kategoriPakaian->harga_kategori ?? 0;
            $berat = $transaksi->berat;
            $totalBayar = ($berat * $hargaKategori) + $hargaLayanan;
        }

        return view('admin.transaksi.edit', compact('transaksi', 'pesanans', 'totalBayar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanan,id',
            'berat' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $pesanan = Pesanan::with(['layanan', 'kategoriPakaian'])->findOrFail($request->pesanan_id);

        $hargaLayanan = $pesanan->layanan->harga_layanan ?? 0;
        $hargaKategori = $pesanan->kategoriPakaian->harga_kategori ?? 0;
        $totalBayar = ($request->berat * $hargaKategori) + $hargaLayanan;

        $transaksi->update([
            'pesanan_id' => $request->pesanan_id,
            'user_id' => $pesanan->user_id,
            'berat' => $request->berat,
            'total_bayar' => $totalBayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }
}
