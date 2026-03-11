<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cadastrado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'cpf',
        'pontuacao_total',
        'pontuacao_gasta',
        'coletas_realizadas',
    ];

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    public function resgates()
    {
        return $this->hasMany(CadastradoReward::class, 'cadastrado_id');
    }

    // Funções
    public function todosResgates()
    {
        return $this->belongsToMany(Reward::class, 'cadastrado_reward')
            ->withPivot('id', 'codigo_resgate', 'pontos_gastos', 'status', 'data_expiracao', 'data_utilizacao', 'data_reembolso', 'created_at')
            ->withTimestamps();
    }

    public function rewardsPendentes()
    {
        return $this->belongsToMany(Reward::class, 'cadastrado_reward')
            ->withPivot('id', 'codigo_resgate', 'pontos_gastos', 'status', 'data_expiracao', 'data_utilizacao', 'data_reembolso', 'created_at')
            ->withTimestamps()
            ->wherePivot('status', 'pendente')
            ->wherePivot('data_expiracao', '>', now());
    }


    public function rewardsUtilizadas()
    {
        return $this->belongsToMany(Reward::class, 'cadastrado_reward')
            ->withPivot('id', 'codigo_resgate', 'pontos_gastos', 'status', 'data_expiracao', 'data_utilizacao', 'data_reembolso', 'created_at')
            ->withTimestamps()
            ->wherePivot('status', 'utilizado');
    }


    public function rewardsReembolsadas()
    {
        return $this->belongsToMany(Reward::class, 'cadastrado_reward')
            ->withPivot('id', 'codigo_resgate', 'pontos_gastos', 'status', 'data_expiracao', 'data_utilizacao', 'data_reembolso', 'created_at')
            ->withTimestamps()
            ->wherePivot('status', 'reembolsado');
    }

    // Accessors
    public function getCpfFormatadoAttribute()
    {
        $cpf = preg_replace('/[^0-9]/', '', $this->cpf);
        return substr($cpf, 0, 3) . '.' .
            substr($cpf, 3, 3) . '.' .
            substr($cpf, 6, 3) . '-' .
            substr($cpf, 9, 2);
    }

    public function getPontosDisponiveisAttribute()
    {
        return $this->pontuacao_total - $this->pontuacao_gasta;
    }

    public function getTotalResgatesAttribute()
    {
        return $this->resgates()->count();
    }

    public function getResgatesPendentesCountAttribute()
    {
        return $this->rewardsPendentes()->count();
    }

    public function getResgatesUtilizadosCountAttribute()
    {
        return $this->rewardsUtilizadas()->count();
    }

    public function getResgatesReembolsadosCountAttribute()
    {
        return $this->rewardsReembolsadas()->count();
    }
}
