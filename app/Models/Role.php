<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'role';

    // Primary key
    protected $primaryKey = 'idrole';

    // Nonaktifkan timestamps
    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_role'
    ];

    // 🟩 Relasi ke tabel user melalui tabel pivot user_role
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'idrole', 'iduser')
                    ->withPivot('status');
    }
}
