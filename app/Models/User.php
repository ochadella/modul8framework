<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ✅ sesuaikan nama tabel di database (kalau tabel kamu bernama 'user', bukan 'users')
    protected $table = 'user';

    // ✅ sesuaikan primary key dengan kolom di tabel kamu
    protected $primaryKey = 'iduser';

    // ✅ kolom yang boleh diisi massal
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    // (opsional) kalau kamu ingin menonaktifkan timestamps
    // public $timestamps = false;

    // ✅ relasi ke tabel Role (DIPERLUKAN supaya User::with('roles') tidak error)
    public function roles()
    {
        // sesuaikan nama tabel pivot dan kolom FK sesuai struktur database kamu
        return $this->belongsToMany(Role::class, 'user_role', 'iduser', 'idrole');
    }
}
