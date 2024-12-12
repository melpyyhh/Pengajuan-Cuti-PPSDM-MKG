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
}
