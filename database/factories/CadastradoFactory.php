<?php

namespace Database\Factories;

use App\Models\Cadastrado;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Rules\Cpf;

class CadastradoFactory extends Factory
{
    protected $model = Cadastrado::class;

    public function definition(): array
    {
        return [
            'cpf' => $this->generateValidCpf(),
            'pontuacao_total' => $pontuacao = $this->faker->numberBetween(1000, 5000),
            'pontuacao_gasta' => $this->faker->numberBetween(0, $pontuacao),
            'coletas_realizadas' => $this->faker->numberBetween(0, 50),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Gera CPF válido usando a Rule de validação
     */
    private function generateValidCpf(): string
    {
        $cpfRule = new Cpf();

        do {
            // Gera 11 números aleatórios
            $cpf = $this->faker->numerify('###########');
        } while (!$cpfRule->passes('cpf', $cpf));

        return $cpf;
    }
}