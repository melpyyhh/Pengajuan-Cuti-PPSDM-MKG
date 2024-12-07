<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan'; // nama tabel
    protected $fillable = ['admin_id', 'pegawai_id', 'status_ajuan', 'descriptions'];

    public function admin()
    {
        return $this->belongsTo(Pegawai::class, 'admin_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public static function getAllWithRelations()
    {
        return self::with(['pegawai', 'admin'])->get();
    }

    public static function countAll()
    {
        return self::count();
    }

    public static function countDitanggapi()
    {
        return self::where('status_ajuan', 'ditanggapi')->count();
    }

    public static function countDaftarTunggu()
    {
        return self::where('status_ajuan', 'daftarTunggu')->count();
    }
}
