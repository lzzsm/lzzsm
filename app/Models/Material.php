<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'categoria',
        'ponto_kg',
        'descricao',
        'ativo'
    ];

    protected $casts = [
        'ponto_kg' => 'integer',
        'ativo' => 'boolean'
    ];

    public function scopeAtivos($query)
    {
        return $query->where('ativo', true);
    }

    public function calcularPontos(float $quantidadeKg): int
    {
        return (int) ($this->ponto_kg * $quantidadeKg);
    }

    // Nova relação com collects
    public function collects()
    {
        return $this->belongsToMany(Collect::class, 'collect_material')
            ->withPivot('peso', 'pontos_calculados')
            ->withTimestamps();
    }

    public function collectMaterials()
    {
        return $this->hasMany(CollectMaterial::class);
    }
}
