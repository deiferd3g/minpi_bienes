<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function movimientosSolicitados(): HasMany
    {
        return $this->hasMany(Movimiento::class, 'solicitado_por');
    }

    public function movimientosAprobados(): HasMany
    {
        return $this->hasMany(Movimiento::class, 'aprobado_por');
    }

    public function actasElaboradas(): HasMany
    {
        return $this->hasMany(Acta::class, 'elaborado_por');
    }

    public function actasAprobadas(): HasMany
    {
        return $this->hasMany(Acta::class, 'aprobado_por');
    }

    public function inventariosResponsable(): HasMany
    {
        return $this->hasMany(Inventario::class, 'responsable_id');
    }

    public function mantenimientosSolicitados(): HasMany
    {
        return $this->hasMany(Mantenimiento::class, 'solicitado_por');
    }

    public function asignacionesAutorizadas(): HasMany
    {
        return $this->hasMany(Asignacion::class, 'autorizado_por');
    }
}
