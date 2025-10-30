<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $fillable = ['pertanyaan', 'jenis_pertanyaan'];
    protected $table = 'pertanyaans';


    public function jawabans()
    {
        return $this->hasMany(Jawaban::class);
    }
}
