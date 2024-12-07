<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = ['nip', 'nama', 'unitKerja', 'masaKerja', 'jabatan'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function pengajuanSebagaiPengaju()
    {
        return $this->hasMany(Pengajuan::class, 'pengaju_id');
    }

    public function pengajuanSebagaiPenyetuju()
    {
        return $this->hasMany(Pengajuan::class, 'penyetuju_id');
    }

    public function pengaduanSebagaiAdmin()
    {
        return $this->hasMany(Pengaduan::class, 'admin_id');
    }

    public function pengaduansAsPegawai()
    {
        return $this->hasMany(Pengaduan::class, 'pegawai_id');
    }

    public function dataCuti()
    {
        return $this->hasMany(DataCuti::class);
    }

    public function riwayatCuti()
    {
        return $this->hasMany(RiwayatCuti::class, 'pegawai_id', 'id');
    }

    public static function getAllPegawai()
    {
        return self::all();
    }
}
