<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;
use Carbon\Carbon;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
                'categoria' => 'Papel',
                'descricao' => 'Inclui jornais, revistas, cadernos, caixas de papelão, folhas de escritório e embalagens papel. Deve estar seco e limpo.',
                'ponto_kg' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'Plástico',
                'descricao' => 'Garrafas PET, embalagens de produtos de limpeza, potes de alimentos, sacolas plásticas e utensílios descartáveis. Lavar antes de descartar.',
                'ponto_kg' => 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'Vidro',
                'descricao' => 'Garrafas de bebidas, frascos de alimentos, potes de conservas e vidros de janelas. Não incluir cristal, espelhos ou vidros temperados.',
                'ponto_kg' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'Metal',
                'descricao' => 'Latas de alumínio (refrigerante, cerveja), latas de aço (conservas), panelas velhas, arames e objetos metálicos em geral.',
                'ponto_kg' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'Eletrônicos',
                'descricao' => 'Celulares, computadores, tablets, cabos, carregadores, pilhas, baterias e pequenos eletrodomésticos. Descarte especial requerido.',
                'ponto_kg' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'Orgânicos',
                'descricao' => 'Restos de alimentos, cascas de frutas e legumes, borra de café, folhas secas e resíduos de jardinagem. Ideal para compostagem.',
                'ponto_kg' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'Têxtil',
                'descricao' => 'Roupas usadas, calçados, toalhas, cortinas e retalhos de tecido. Devem estar limpos e em condições de reutilização ou reciclagem.',
                'ponto_kg' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'Madeira',
                'descricao' => 'Móveis antigos, pallets, caixas de feira, restos de construção civil (desde que não tratados com produtos químicos).',
                'ponto_kg' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'Pilhas e Baterias',
                'descricao' => 'Pilhas alcalinas, baterias de celular, baterias de notebook e acumuladores. Material de alto risco ambiental - descarte correto essencial.',
                'ponto_kg' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'Óleo de Cozinha',
                'descricao' => 'Óleo vegetal usado em frituras. Armazenar em garrafa PET fechada. Nunca descartar na pia ou vaso sanitário.',
                'ponto_kg' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
