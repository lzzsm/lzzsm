<?php

namespace Database\Factories;

use App\Models\Reward;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RewardFactory extends Factory
{
    protected $model = Reward::class;

    public function definition()
{
    return [
        'titulo' => $this->faker->words(3, true),
        'descricao' => $this->faker->sentence(8),
        'pontos_necessarios' => $this->faker->numberBetween(2000, 10000),
        'qtd_disponivel' => $this->faker->numberBetween(1, 50),
        'empresa_id' => Empresa::inRandomOrder()->first()->id,
        'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        'updated_at' => now(),
    ];
}
}