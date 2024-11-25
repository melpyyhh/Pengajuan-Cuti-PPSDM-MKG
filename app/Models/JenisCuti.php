<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    protected $table = 'jenis_cuti';
    protected $fillable = ['jenis_cuti'];

    public function pegawais()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawai_cuti')->withPivot('jumlah_cuti');
    }
}
