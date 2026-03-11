<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'empresa_id',
        'titulo',
        'descricao',
        'pontos_necessarios',
        'qtd_disponivel',
        'img_recompensa',
    ];

    protected $casts = [
        'pontos_necessarios' => 'integer',
        'qtd_disponivel' => 'integer',
    ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function resgates()
    {
        return $this->hasMany(CadastradoReward::class, 'reward_id');
    }

    public function cadastradosQueResgataram()
    {
        return $this->belongsToMany(Cadastrado::class, 'cadastrado_reward')
            ->withPivot('codigo_resgate', 'pontos_gastos', 'status', 'data_expiracao')
            ->withTimestamps();
    }

    public function isAvailable(): bool
    {
        return $this->qtd_disponivel > 0;
    }

    public function decrementQuantity(): void
    {
        if ($this->qtd_disponivel > 0) {
            $this->decrement('qtd_disponivel');
        } else {
            throw new \Exception('Recompensa esgotada.');
        }
    }

    public function incrementQuantity(int $quantidade = 1): void
    {
        $this->increment('qtd_disponivel', $quantidade);
    }
}
