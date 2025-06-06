<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pesanan;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = ['nama_layanan', 'harga_layanan'];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'layanan_id');
    }
}
