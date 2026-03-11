<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Cadastrado;
use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('senha123'),
            'remember_token' => Str::random(10),
            'nivel_permissao' => 'cadastrado',
        ];
    }

    /**
     * Cria um usuário com registro na tabela cadastrados.
     */
    public function cadastrado()
    {
        return $this->afterCreating(function (User $user) {
            Cadastrado::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }

    /**
     * Cria um usuário com registro na tabela empresas.
     */
    public function empresa()
    {
        return $this->afterCreating(function (User $user) {
            $user->update([
                'nivel_permissao' => 'empresa',
            ]);

            Empresa::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }

    /**
     * Indica que o email não foi verificado.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
