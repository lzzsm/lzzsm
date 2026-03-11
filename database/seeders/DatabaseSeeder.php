<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cadastrado;
use App\Models\Empresa;
use App\Models\Advertisement;
use App\Models\Reward;
use App\Models\CollectPoint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cria Admin fixo com credenciais específicas
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
            'nivel_permissao' => 'admin',
        ]);

        // Vincula admin na tabela cadastrados com CPF específico
        Cadastrado::create([
            'user_id' => $admin->id,
            'cpf' => '48529146808',
            'pontuacao_total' => 0,
            'pontuacao_gasta' => 0,
            'coletas_realizadas' => 0,
        ]);

        // Cria usuários cadastrados
        User::factory()->count(20)->cadastrado()->create();

        // Cria empresas
        User::factory()->count(10)->empresa()->create();

        // Cria anúncios (depende de empresas)
        Advertisement::factory()->count(15)->create();

        // Cria recompensas (depende de empresas)
        Reward::factory()->count(15)->create();

        // Cria pontos de coleta
        CollectPoint::factory()->count(10)->create();

        $this->call([
            MaterialsTableSeeder::class,
        ]);
    }
}