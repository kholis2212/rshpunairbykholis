<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: satu user memiliki satu pemilik
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    // Relasi: satu user memiliki banyak role_user
    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }

    // Relasi many-to-many: user memiliki banyak role melalui role_user
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole');
    }
}