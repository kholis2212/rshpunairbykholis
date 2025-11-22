<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = false;

    protected $fillable = [
        'no_wa',
        'alamat',
        'iduser',
        'nama'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    // Relasi ke Pet (hewan peliharaan)
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }

     // Scope untuk pemilik berdasarkan user ID
    public function scopeByUserId($query, $userId)
    {
        return $query->where('iduser', $userId);
    }

    // Relasi ke Reservasi
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'idpemilik', 'idpemilik');
    }
}