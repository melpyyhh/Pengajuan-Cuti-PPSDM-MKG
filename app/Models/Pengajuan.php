<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    /** @use HasFactory<\Database\Factories\PengajuanFactory> */
    use HasFactory;

    protected $fillable = ['pengaju_id', 'penyetuju_id', 'cuti_id', 'alasan', 'tanggal_awal', 'tanggal_akhir'];

    public function pengaju()
    {
        return $this->belongsTo(Pegawai::class, 'pengaju_id');
    }

    public function penyetuju()
    {
        return $this->belongsTo(Pegawai::class, 'penyetuju_id');
    }

    public function cuti()
    {
        return $this->belongsTo(JenisCuti::class);
    }

    public function riwayatCuti()
    {
        return $this->hasOne(RiwayatCuti::class);
    }

    public function prosesCuti()
    {
        return $this->hasOne(ProsesCuti::class);
    }
}
