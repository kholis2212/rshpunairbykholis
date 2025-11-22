<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $timestamps = false;

    protected $fillable = [
        'alamat',
        'no_hp',
        'bidang_dokter',
        'jenis_kelamin',
        'iduser',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    // Relasi ke RekamMedis
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_pemeriksa', 'id_dokter');
    }

    // Relasi ke TemuDokter
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idrole_user', 'id_dokter');
    }
}