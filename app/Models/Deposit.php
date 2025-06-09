<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
protected $table = 'deposit';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'metode_pembayaran',
        'bukti',
        'status',
        'nominal_before',
        'nominal',  
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'nominal' => 'integer',
            'nominal_before'=>'integer',
        ];
    }

    /**
     * Get the user that owns the deposit.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
