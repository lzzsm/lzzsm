<?php

namespace Database\Factories;

use App\Models\Advertisement;
use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisementFactory extends Factory
{
    // Define qual model esta factory representa
    protected $model = Advertisement::class;

    // Retorna os dados padrão para criar um anúncio
    public function definition(): array
    {
        // Busca todos os IDs de empresas existentes no banco
        $empresaIds = Empresa::pluck('id')->toArray();

        return [
            // Gera um título com 4 palavras
            'titulo' => $this->faker->sentence(4),

            // Gera um subtítulo com 8 palavras
            'subtitulo' => $this->faker->sentence(8),

            // Gera o conteúdo com 3 parágrafos
            'conteudo' => $this->faker->paragraphs(3, true),

            // Escolhe um tipo aleatório da lista
            'tipo' => $this->faker->randomElement(['Parceria', 'Comunicado', 'Promoção', 'Informativo', 'Evento']),

            // Define a imagem como nula por padrão
            'img_anuncio' => null,

            // Associa a uma empresa aleatória existente, ou null se não houver empresas
            'empresa_id' => !empty($empresaIds) ? $empresaIds[array_rand($empresaIds)] : null,
        ];
    }
}
