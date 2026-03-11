<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectMaterial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'collect_material';

    protected $fillable = [
        'collect_id',
        'material_id', 
        'peso',
        'pontos_calculados'
    ];

    public function collect()
    {
        return $this->belongsTo(Collect::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}