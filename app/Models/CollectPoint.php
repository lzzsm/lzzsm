<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectPoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'rua',
        'numero',
        'cep',
        'cidade',
        'estado',
    ];

    public function collects()
    {
        return $this->hasMany(Collect::class);
    }

    public function getCepFormatadoAttribute(): ?string
    {
        if (!$this->cep) return null;

        $cep = preg_replace('/\D/', '', $this->cep);
        return strlen($cep) === 8 ? substr($cep, 0, 5) . '-' . substr($cep, 5, 3) : $this->cep;
    }

    public function getEnderecoCompletoAttribute(): string
    {
        $endereco = $this->rua;
        if ($this->numero) $endereco .= ', ' . $this->numero;
        $endereco .= ' - ' . $this->cidade;
        if ($this->estado) $endereco .= '/' . $this->estado;
        if ($this->cep_formatado) $endereco .= ' - ' . $this->cep_formatado;
        return $endereco;
    }
}
