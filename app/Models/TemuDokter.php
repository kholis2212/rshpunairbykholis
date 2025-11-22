<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
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

    protected $casts = [
        'waktu_daftar' => 'datetime',
    ];

    // Relasi ke Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relasi ke RoleUser (Dokter)
    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    // Relasi ke User melalui RoleUser
    public function userDokter()
    {
        return $this->hasOneThrough(
            User::class,
            RoleUser::class,
            'idrole_user',
            'iduser',
            'idrole_user',
            'iduser'
        );
    }

    // Relasi ke Pemilik melalui Pet
    public function pemilik()
    {
        return $this->hasOneThrough(
            Pemilik::class,
            Pet::class,
            'idpet',
            'idpemilik',
            'idpet',
            'idpemilik'
        );
    }

      // Scope untuk reservasi berdasarkan pet pemilik
    public function scopeByPemilik($query, $pemilikId)
    {
        return $query->whereHas('pet', function($q) use ($pemilikId) {
            $q->where('idpemilik', $pemilikId);
        });
    }


    // Scope untuk temu dokter hari ini
    public function scopeHariIni($query)
    {
        return $query->whereDate('waktu_daftar', today());
    }

    // Scope untuk status aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'A');
    }

    // Scope untuk status selesai
    public function scopeSelesai($query)
    {
        return $query->where('status', 'S');
    }

    // Scope untuk status cancel
    public function scopeCancel($query)
    {
        return $query->where('status', 'C');
    }

    // Accessor untuk status lengkap
    public function getStatusLengkapAttribute()
    {
        return match($this->status) {
            'A' => 'Aktif',
            'S' => 'Selesai',
            'C' => 'Dibatalkan',
            default => 'Tidak Diketahui'
        };
    }

    // Accessor untuk warna status
    public function getWarnaStatusAttribute()
    {
        return match($this->status) {
            'A' => 'success',
            'S' => 'primary',
            'C' => 'danger',
            default => 'secondary'
        };
    }

    // Method untuk mendapatkan nomor antrian berikutnya
    public static function getNextQueueNumber()
    {
        $lastQueue = self::hariIni()->max('no_urut');
        return ($lastQueue ?? 0) + 1;
    }

    // Method untuk update status
    public function updateStatus($status)
    {
        $this->update(['status' => $status]);
        return $this;
    }
}