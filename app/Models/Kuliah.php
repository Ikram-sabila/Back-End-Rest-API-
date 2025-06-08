<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuliah extends Model
{
    protected $table = 'kuliah';
    protected $fillable = ['biodata_id', 'nama_kampus', 'jurusan', 'tahun_masuk', 'tahun_lulus'];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }
}
