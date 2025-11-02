<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    use HasFactory;

    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori_klinis',
    ];

    // Relasi: satu kategori klinis memiliki banyak kode tindakan terapi
    public function kodeTindakanTerapi()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}