<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = ['nama_jurusan', 'deskripsi', 'prospek_kerja', 'kampus_rekomendasi'];
    protected $table = 'jurusans';


    public function jawabans()
    {
        return $this->hasMany(Jawaban::class);
    }
}
