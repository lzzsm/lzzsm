<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'cadastrado_id',
        'avaliacao',
        'conteudo'
    ];

    protected $casts = [
        'avaliacao' => 'integer',
    ];

    public function cadastrado()
    {
        return $this->belongsTo(Cadastrado::class);
    }

    public static function mediaAvaliacoes(): float
    {
        return (float) self::avg('avaliacao');
    }

    public static function rules()
    {
        return [
            'avaliacao' => 'required|integer|between:1,5',
            'conteudo' => 'nullable|string|max:1000'
        ];
    }

    public function getAvaliacaoEstrelasAttribute(): string
    {
        return str_repeat('⭐', $this->avaliacao) . str_repeat('☆', 5 - $this->avaliacao);
    }
}
