<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesCuti extends Model
{
    /** @use HasFactory<\Database\Factories\ProsesCutiFactory> */
    use HasFactory;

    protected $fillable = ['pengajuan_id', 'cuti_id', 'pegawai_id', 'status_ajuan'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function cuti()
    {
        return $this->belongsTo(JenisCuti::class, 'cuti_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
