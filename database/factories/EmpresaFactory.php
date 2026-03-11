<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Rules\Cnpj;

class EmpresaFactory extends Factory
{
    protected $model = Empresa::class;

    public function definition(): array
    {
        return [
            'cnpj' => $this->generateValidCnpj(),
            'telefone_comercial' => $this->faker->phoneNumber(),
            'descricao' => $this->faker->paragraph(3),
            'site' => $this->faker->url(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Gera CNPJ válido usando a Rule de validação
     */
    private function generateValidCnpj(): string
    {
        $cnpjRule = new Cnpj();

        do {
            // Gera 14 números aleatórios
            $cnpj = $this->faker->numerify('##############');
        } while (!$cnpjRule->passes('cnpj', $cnpj));

        return $cnpj;
    }
}