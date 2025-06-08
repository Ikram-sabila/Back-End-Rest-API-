<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'biodata';

    protected $fillable = [
        'nama',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_hp',
        'foto'
    ];

    public function kuliah()
    {
        return $this->hasMany(Kuliah::class);
    }

    public function pengalaman()
    {
        return $this->hasMany(Pengalaman::class);
    }
}
