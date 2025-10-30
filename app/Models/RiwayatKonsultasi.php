<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKonsultasi extends Model
{
    protected $fillable = ['user_id', 'hasil'];
    protected $table = 'riwayat_konsultasis';

    protected $casts = [
        'hasil' => 'array', // Otomatis mengkonversi JSON ke array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
