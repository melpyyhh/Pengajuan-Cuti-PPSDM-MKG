<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatCuti extends Model
{
    /** @use HasFactory<\Database\Factories\RiwayatCutiFactory> */
    use HasFactory;
    protected $table = 'riwayat_cutis';
    protected $guarded = [];
    protected $fillable = ['pengajuan_id', 'cuti_id', 'pegawai_id', 'lama_cuti', 'status_ajuan', 'tanggal_awal', 'tanggal_akhir'];

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
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }

    public static function getByPegawaiId($pegawaiId)
    {
        return self::where('pegawai_id', $pegawaiId);
    }

    public static function getByPengajuanId($pengajuanId)
    {
        return self::where('pengajuan_id', $pengajuanId)->get();
    }
}
