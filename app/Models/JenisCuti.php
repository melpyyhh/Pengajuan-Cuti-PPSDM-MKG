<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    protected $table = 'jenis_cuti';
    protected $fillable = ['jenis_cuti'];

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }

    public function dataCutis()
    {
        return $this->hasMany(DataCuti::class);
    }
}
