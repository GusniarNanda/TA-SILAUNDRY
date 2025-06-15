<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriPakaian;
use App\Models\Layanan;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'kategori_pakaian_id',  // ini foreign key
        'layanan_id',           // ini foreign key
        'waktu_jemput',
        'waktu_antar',
        'opsi_antar_jemput',
        'status',
        'catatan',
        'user_id',
        'berat',
    ];

    // Pastikan import model relasi di atas file ini:
    // use App\Models\KategoriPakaian;
    // use App\Models\Layanan;

    public function kategoriPakaian()
    {
        return $this->belongsTo(KategoriPakaian::class, 'kategori_pakaian_id');
    }

    public function layanan()   
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
