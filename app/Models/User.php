<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pegawai_id',
        'name',
        'email',
        'password',
        'role',
        'atasan_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public static function tambahUser($data)
    {
        return self::create([
            'pegawai_id' => $data['pegawai_id'],
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => $data['password'],
            'role' => $data['role'],
            'atasan_id' => $data['atasan_id']
        ]);
    }
}
