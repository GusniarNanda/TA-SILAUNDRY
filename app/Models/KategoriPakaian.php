<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pesanan;

class KategoriPakaian extends Model
{
    use HasFactory;

    protected $table = 'kategori_pakaians';

    protected $fillable = ['nama_kategori', 'harga_kategori'];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'kategori_pakaian_id');
    }
}
