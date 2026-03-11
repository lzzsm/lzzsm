<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'cnpj',
        'telefone_comercial', 
        'descricao',
        'site',
    ];

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advertisements(): HasMany
    {
        return $this->hasMany(Advertisement::class);
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }

    // Accessors
    public function getCnpjFormatadoAttribute()
    {
        return substr($this->cnpj, 0, 2) . '.' .
            substr($this->cnpj, 2, 3) . '.' .
            substr($this->cnpj, 5, 3) . '/' .
            substr($this->cnpj, 8, 4) . '-' .
            substr($this->cnpj, 12, 2);
    }

    public function getTelefoneComercialFormatadoAttribute()
    {
        $numero = preg_replace('/\D/', '', $this->telefone_comercial);

        if (strlen($numero) === 11) {
            return '(' . substr($numero, 0, 2) . ') ' .
                substr($numero, 2, 5) . '-' .
                substr($numero, 7);
        }

        if (strlen($numero) === 10) {
            return '(' . substr($numero, 0, 2) . ') ' .
                substr($numero, 2, 4) . '-' .
                substr($numero, 6);
        }

        return $this->telefone_comercial;
    }
}