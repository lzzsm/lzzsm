<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collect extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cadastrado_id',
        'collect_point_id',
        'status',
        'data',
        'data_validacao',
        'pontos_gerados',
        'observacoes'
    ];

    protected $casts = [
        'data' => 'datetime',
        'data_validacao' => 'datetime',
        'pontos_gerados' => 'integer'
    ];

    // Relações
    public function cadastrado()
    {
        return $this->belongsTo(Cadastrado::class);
    }

    public function collectPoint()
    {
        return $this->belongsTo(CollectPoint::class);
    }

    public function collectMaterials()
    {
        return $this->hasMany(CollectMaterial::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'collect_material')
            ->withPivot('peso', 'pontos_calculados')
            ->withTimestamps();
    }

    public function hasDeletedMaterials()
    {
        return $this->materials()->whereNotNull('deleted_at')->exists();
    }
}
