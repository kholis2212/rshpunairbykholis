<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $timestamps = false;

    protected $fillable = [
        'no_urut',
        'waktu_daftar',
        'status',
        'idpet',
        'idrole_user'
    ];

    // Relasi ke Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relasi ke User (dokter)
    public function dokter()
    {
        return $this->belongsTo(User::class, 'idrole_user', 'iduser');
    }

    // Relasi ke Pemilik melalui Pet
    public function pemilik()
    {
        return $this->hasOneThrough(Pemilik::class, Pet::class, 'idpet', 'idpemilik', 'idpet', 'idpemilik');
    }
}