<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan'; // nama tabel
    protected $fillable = ['admin_id', 'pegawai_id', 'status_pengaduan', 'title', 'descriptions'];

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

    public static function getAllWithRelationsByTitle($title)
    {
        //Mengambil seluruh pengaduan berdasarkan title tertentu
        return self::where('title', 'like', '%' . $title . '%')
                ->with(['pegawai', 'admin'])
                ->get();
    }

    public static function countAll()
    {
        return self::count();
    }

    public static function countDitanggapi()
    {
        return self::where('status_pengaduan', 'ditanggapi')->count();
    }

    public static function countDaftarTunggu()
    {
        return self::where('status_pengaduan', 'daftarTunggu')->count();
    }

    public static function getByPegawaiId($pegawaiId)
    {
        return self::where('pegawai_id', $pegawaiId)->with(['pegawai', 'admin'])->get();
    }
    
    public static function countAllByPegawaiId($pegawaiId)
    {
        return self::where('pegawai_id', $pegawaiId)->count();
    }
    
    public static function getAllWithRelationsByTitleAndPegawaiId($title, $pegawaiId)
    {
        //Mengambil seluruh pengaduan berdasarkan title dan pegawai id tertentu
        return self::where('title', 'like', '%' . $title . '%')
                ->where('pegawai_id', $pegawaiId)
                ->with(['pegawai', 'admin'])
                ->get();
    }

    public static function countDitanggapiByPegawaiId($pegawaiId)
    {
        return self::where('pegawai_id', $pegawaiId)
            ->where('status_pengaduan', 'ditanggapi')
            ->count();
    }

    public static function countDaftarTungguByPegawaiId($pegawaiId)
    {
        return self::where('pegawai_id', $pegawaiId)
            ->where('status_pengaduan', 'daftarTunggu')
            ->count();
    }

    public static function aduan($data)
    {
        try {
            $pengaduan = self::create([
                'admin_id' => $data['admin_id'],
                'pegawai_id' => $data['pegawai_id'],
                'status_pengaduan' => 'daftarTunggu',
                'title' => $data['title'],
                'descriptions' => $data['descriptions'],
            ]);
            return $pengaduan;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public static function updateStatusReply($data)
    {
        try {
            $pengaduan = Pengaduan::find($data['id']);
            if (!$pengaduan) {
                throw new \Exception('Pengaduan tidak ditemukan.');
            }
            Pengaduan::where('id', $data['id'])->update([
                'admin_id' => $data['admin_id'],
                'status_pengaduan' => $data['status'],
                'reply' => $data['reply'],
            ]);
        } catch (\Throwable $e) { {
                throw $e;
            }
        }
    }
}
