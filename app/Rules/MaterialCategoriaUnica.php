<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Material;
use Illuminate\Support\Str;

class MaterialCategoriaUnica implements Rule
{
    protected $materialId;

    public function __construct($materialId = null)
    {
        $this->materialId = $materialId;
    }

    public function passes($attribute, $value)
    {
        // Normaliza a categoria para comparação
        $categoriaNormalizada = $this->normalizarTexto($value);

        // Query otimizada no banco
        $query = Material::query();

        // Exclui o material atual (para updates)
        if ($this->materialId) {
            $query->where('id', '!=', $this->materialId);
        }

        // Busca todos os materiais (são poucos registros, então é aceitável)
        $materiais = $query->get(['id', 'categoria']);

        // Verifica se existe algum material com a categoria normalizada igual
        foreach ($materiais as $material) {
            if ($this->normalizarTexto($material->categoria) === $categoriaNormalizada) {
                return false;
            }
        }

        return true;
    }

    /**
     * Normaliza o texto para comparação:
     * - Remove acentos
     * - Converte para minúsculas
     * - Remove espaços extras
     * - Remove caracteres especiais
     */
    private function normalizarTexto($texto)
    {
        return Str::lower(
            preg_replace(
                '/[^\w]/',
                '',
                Str::ascii($texto)
            )
        );
    }

    public function message()
    {
        return 'Já existe um material com esta categoria.';
    }
}
