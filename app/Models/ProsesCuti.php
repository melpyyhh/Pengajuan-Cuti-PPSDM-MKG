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
    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->whereHas('pegawai', function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                      ->orWhere('nip', 'LIKE', "%{$search}%")
                      ->orWhere('unitKerja', 'LIKE', "%{$search}%");
            })
            ->orWhere('status_ajuan', 'LIKE', "%{$search}%");
        });
    }
}
