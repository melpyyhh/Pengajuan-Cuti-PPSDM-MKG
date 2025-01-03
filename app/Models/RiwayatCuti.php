<?php

namespace App\Models;

use Carbon\Carbon;
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

    public static function cekCutiBesar($pegawaiId)
    {
        $cutiBesarTerakhir = RiwayatCuti::where('pegawai_id', $pegawaiId)
            ->where('cuti_id', 4)
            ->where('status_ajuan', 'disetujui')
            ->where('tanggal_awal', '>=', Carbon::now()->subYears(5))
            ->orderBy('tanggal_awal', 'desc')
            ->first();

        $eligible = !$cutiBesarTerakhir;

        if ($eligible) {
            return true;
        }
        return  false;
    }
}
