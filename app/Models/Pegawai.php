<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $guarded = [];

    public function jenisCuti()
    {
        return $this->belongsToMany(JenisCuti::class, 'pegawai_cuti')->withPivot('jumlah_cuti');
    }
}
