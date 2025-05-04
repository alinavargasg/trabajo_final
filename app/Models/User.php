<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function prestamos(){
        return $this->hasMany(Prestamo::class, 'lector_id', 'id');
    }

    public function tienePrestamosPendientes(): bool{
        //Verifica que el lector no tenga préstamos pendientes de devolución.
        return $this->prestamos()
        ->whereIn('estado', ['1', '3', '0']) // ['pendiente', 'renovado', 'perdido en préstamo']
        ->exists();    
    }

    public function name(){
        return $this->name;
    }

}
