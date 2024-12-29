<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Pengajuan extends Model
{
    /** @use HasFactory<\Database\Factories\PengajuanFactory> */
    use HasFactory;

    protected $fillable = ['pengaju_id', 'penyetuju_id', 'cuti_id', 'alasan', 'tanggal_awal', 'tanggal_akhir', 'alamatCuti', 'nomorHp', 'selama'];

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
        return $this->belongsTo(JenisCuti::class, 'cuti_id');
    }

    public function riwayatCuti()
    {
        return $this->hasOne(RiwayatCuti::class);
    }

    public function prosesCuti()
    {
        return $this->hasOne(ProsesCuti::class);
    }

    public static function ajukanCuti($data)
    {
        $pengajuan = self::create([
            'pengaju_id' => $data['pengaju_id'],
            'penyetuju_id' => $data['penyetuju_id'],
            'cuti_id' => $data['cuti_id'],
            'alasan' => $data['alasan'],
            'tanggal_awal' => $data['tanggal_awal'],
            'tanggal_akhir' => $data['tanggal_akhir'],
            'nomorHp' => $data['nomorHp'],
            'selama' => $data['selama'],
            'alamatCuti' => $data['alamat'],
        ]);

        ProsesCuti::create([
            'pengajuan_id' => $pengajuan->id,
            'cuti_id' => $pengajuan->cuti_id,
            'pegawai_id' => $pengajuan->pengaju_id,
            'status_ajuan' => 'diproses', // Status 'diproses' saat pengajuan dibuat
        ]);

        RiwayatCuti::create([
            'pengajuan_id' => $pengajuan->id,
            'cuti_id' => $pengajuan->cuti_id,
            'pegawai_id' => $pengajuan->pengaju_id,
            'lama_cuti' => $pengajuan->selama,
            'status_ajuan' => 'diproses',
            'tanggal_awal' => $pengajuan->tanggal_awal,
            'tanggal_akhir' => $pengajuan->tanggal_akhir
        ]);
        return $pengajuan;
    }

    public static function updateStatus($data)
    {
        try {
            $pengajuan = Pengajuan::find($data['id']);
            if (!$pengajuan) {
                throw new \Exception('Pengajuan tidak ditemukan.');
            }
            ProsesCuti::where('pengajuan_id', $pengajuan->id)
                ->update(['status_ajuan' => $data['status']]);
            RiwayatCuti::where('pengajuan_id', $pengajuan->id)
                ->update(['status_ajuan' => $data['status']]);
        } catch (\Throwable $e) { {
                throw $e;
            }
        }
    }

    public static function deletePengajuan($idRiwayat)
    {
        try {
            $riwayatCuti = RiwayatCuti::find($idRiwayat);
            if ($riwayatCuti && $riwayatCuti->status_ajuan === "diproses") {
                $pengajuan = self::find($riwayatCuti->pengajuan_id);

                if ($pengajuan) {
                    $pengajuan->delete();
                    return true; // Penghapusan berhasil
                }
            }
            return false; // Data tidak valid
        } catch (\Throwable $e) {
            // Return exception jika terjadi error
            throw $e;
        }
    }
}
