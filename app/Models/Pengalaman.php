<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    protected $table = 'pengalaman';

    protected $fillable = ['biodata_id', 'nama_perusahaan', 'posisi', 'tahun_mulai', 'tahun_selesai'];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }
}
