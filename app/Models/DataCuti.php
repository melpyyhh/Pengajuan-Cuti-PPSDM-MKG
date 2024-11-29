<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataCuti extends Model
{
    protected $table = 'data_cuti';
    protected $fillable = ['pegawai_id', 'jenis_cuti_id', 'jumlah_cuti', 'sisa_cuti'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class);
    }
}
