<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataCuti extends Model
{
    protected $table = 'data_cutis';
    protected $fillable = ['pegawais_id', 'jenis_cuti_id', 'jumlah_cuti', 'sisa_cuti'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class);
    }

    public static function tambahDataCuti($data)
    {
        return self::create([
            'pegawais_id' => $data['pegawai_id'],
            'jenis_cuti_id' => $data['jenis_cuti_id'],
            'jumlah_cuti' => $data['jumlah_cuti'],
            'sisa_cuti' => $data['sisa_cuti'],
        ]);
    }

    public static function cekDataCuti($idPegawai)
    {
        return DataCuti::where('pegawais_id', $idPegawai)->exists();
    }

    public static function updateDataCuti($data)
    {
        // Validasi input data
        if (!isset($data['pegawai_id'], $data['cuti_id'], $data['tahun'], $data['selama'])) {
            return 'Data tidak lengkap';
        }
        $durasiCuti = $data['selama'];
        if ($data['cuti_id'] == 1) { // Cuti tahunan
            $tahunSebelumnya = [$data['tahun'] - 2, $data['tahun'] - 1]; // Tahun 2 tahun sebelumnya dan 1 tahun sebelumnya

            // Prefetch data untuk efisiensi
            $cutiSebelumnya = self::where('pegawais_id', $data['pegawai_id'])
                ->where('jenis_cuti_id', $data['cuti_id'])
                ->whereIn('tahun', $tahunSebelumnya)
                ->orderBy('tahun', 'asc') // Pastikan urutan dari tahun terlama ke terbaru
                ->get();

            // Iterasi melalui data yang ditemukan
            foreach ($cutiSebelumnya as $cuti) {
                if ($cuti->sisa_cuti > 0) {
                    $pengurangan = min($durasiCuti, $cuti->sisa_cuti);
                    $cuti->sisa_cuti -= $pengurangan;
                    $cuti->save();
                    $durasiCuti -= $pengurangan;
                    // Jika durasi cuti sudah terpenuhi, keluar dari loop
                    if ($durasiCuti == 0) {
                        return true;
                    }
                }
            }
            // Jika durasi cuti masih tersisa, kurangi dari sisa cuti tahun ini
            $cutiSaatIni = self::where('pegawais_id', $data['pegawai_id'])
                ->where('jenis_cuti_id', $data['cuti_id'])
                ->where('tahun', $data['tahun'])
                ->first();
            if ($cutiSaatIni) {
                if ($cutiSaatIni->sisa_cuti >= $durasiCuti) {
                    $cutiSaatIni->sisa_cuti -= $durasiCuti;
                    $cutiSaatIni->save();
                    return true;
                } else {
                    return 'Sisa cuti tidak mencukupi untuk tahun ini';
                }
            } else {
                return 'Data cuti tahun ini tidak ditemukan';
            }
        }

        return 'Jenis cuti tidak valid';
    }
}
