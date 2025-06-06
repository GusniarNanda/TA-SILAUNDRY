<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
class Paket extends Model
{
    use HasFactory;
    protected $table = 'paket';
    protected $fillable = [
        'nama_paket',
        'jenis_paket',
        'harga',
        'layanan_id',
        'kategori_id',
    ];

    //relasi ke tabel layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
    
    //relasi ke tabel kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriPakaian::class, 'kategori_id');
    }
}
