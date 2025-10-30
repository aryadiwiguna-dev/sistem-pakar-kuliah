<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $fillable = ['pertanyaan_id', 'jurusan_id', 'opsi_jawaban', 'bobot'];
    protected $table = 'jawabans';

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
