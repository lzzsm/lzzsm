<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, TwoFactorAuthenticatable, SoftDeletes, HasFactory, HasProfilePhoto, Notifiable;

    protected $fillable = [
        'name',
        'email', 
        'password',
        'nivel_permissao',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relacionamentos
    public function cadastrado()
    {
        return $this->hasOne(Cadastrado::class);
    }

    public function empresa()
    {
        return $this->hasOne(Empresa::class);
    }

    // Métodos de verificação
    public function isAdmin(): bool
    {
        return $this->nivel_permissao === 'admin';
    }

    public function isEmpresa(): bool
    {
        return $this->nivel_permissao === 'empresa';
    }

    public function isCadastrado(): bool
    {
        return $this->nivel_permissao === 'cadastrado';
    }

    // Accessors
    public function getTipoUsuarioAttribute(): string
    {
        return match ($this->nivel_permissao) {
            'admin' => 'Administrador',
            'empresa' => 'Empresa',
            'cadastrado' => 'Usuário Comum',
            default => 'Tipo Desconhecido'
        };
    }
}