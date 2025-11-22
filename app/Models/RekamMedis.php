<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = true;

    protected $fillable = [
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idpet',
        'dokter_pemeriksa',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relasi ke Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relasi ke Dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_pemeriksa', 'id_dokter');
    }

    // Relasi ke DetailRekamMedis
    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    public function dokterPemeriksa()
{
    return $this->belongsTo(Dokter::class, 'iddokter', 'iddokter');
}

}