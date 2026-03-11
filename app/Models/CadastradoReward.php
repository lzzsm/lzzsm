<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class CadastradoReward extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cadastrado_reward';

    protected $fillable = [
        'cadastrado_id',
        'reward_id',
        'codigo_resgate',
        'data_expiracao',
        'status',
        'pontos_gastos',
        'data_utilizacao',
        'data_reembolso',
    ];

    protected $casts = [
        'data_expiracao' => 'datetime',
        'data_utilizacao' => 'datetime',
        'data_reembolso' => 'datetime',
    ];

    public function cadastrado()
    {
        return $this->belongsTo(Cadastrado::class);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    public static function gerarCodigoResgateUnico(): string
    {
        do {
            $codigo = 'REC' . strtoupper(substr(md5(uniqid()), 0, 7));
        } while (self::where('codigo_resgate', $codigo)->exists());

        return $codigo;
    }

    public function getTempoRestanteAttribute(): string
    {
        if (!$this->data_expiracao) {
            return 'Expirado/Utilizado';
        }

        return $this->data_expiracao->diffForHumans();
    }
}
