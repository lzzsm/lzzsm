<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Telefone implements Rule
{
    public function passes($attribute, $value)
    {
        $telefone = preg_replace('/[^0-9]/', '', $value);
        $tamanho = strlen($telefone);

        if (empty($telefone)) {
            return true;
        }

        // Verifica se é um DDD válido (11 a 99)
        $ddd = substr($telefone, 0, 2);
        if ($ddd < 11 || $ddd > 99) {
            return false;
        }

        return $tamanho === 10 || $tamanho === 11;
    }

    public function message()
    {
        return 'O número de telefone informado não é válido.';
    }
}
