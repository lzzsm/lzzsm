<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CollectPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // CEPs reais de TODOS os estados brasileiros
        $cepsPorEstado = [
            'AC' => ['69900-970', '69980-000', '69915-898'], // Acre
            'AL' => ['57010-010', '57020-900', '57051-190'], // Alagoas
            'AP' => ['68900-073', '68901-160', '68911-420'], // Amapá
            'AM' => ['69005-140', '69010-095', '69037-290'], // Amazonas
            'BA' => ['40010-010', '40020-280', '40140-110'], // Bahia
            'CE' => ['60010-010', '60150-161', '60320-001'], // Ceará
            'DF' => ['70040-010', '70390-125', '70610-400'], // Distrito Federal
            'ES' => ['29010-909', '29018-210', '29055-231'], // Espírito Santo
            'GO' => ['74003-010', '74150-140', '74333-010'], // Goiás
            'MA' => ['65010-902', '65020-480', '65076-877'], // Maranhão
            'MT' => ['78005-380', '78010-005', '78048-755'], // Mato Grosso
            'MS' => ['79002-010', '79010-190', '79044-040'], // Mato Grosso do Sul
            'MG' => ['30110-000', '30130-140', '30190-050'], // Minas Gerais
            'PA' => ['66010-010', '66023-905', '66055-260'], // Pará
            'PB' => ['58010-270', '58039-540', '58051-085'], // Paraíba
            'PR' => ['80010-010', '80045-180', '80240-000'], // Paraná
            'PE' => ['50010-100', '50030-230', '50610-000'], // Pernambuco
            'PI' => ['64000-150', '64017-420', '64034-380'], // Piauí
            'RJ' => ['20010-020', '20031-140', '20211-350'], // Rio de Janeiro
            'RN' => ['59010-010', '59020-500', '59064-500'], // Rio Grande do Norte
            'RS' => ['90010-010', '90160-092', '90619-900'], // Rio Grande do Sul
            'RO' => ['76804-128', '76820-052', '76824-088'], // Rondônia
            'RR' => ['69301-970', '69303-420', '69313-632'], // Roraima
            'SC' => ['88010-010', '88015-700', '88025-301'], // Santa Catarina
            'SP' => ['01001-000', '01310-100', '04013-000'], // São Paulo
            'SE' => ['49010-020', '49015-190', '49035-500'], // Sergipe
            'TO' => ['77001-014', '77006-084', '77016-532'], // Tocantins
        ];

        // Escolhe um estado aleatório
        $estado = $this->faker->randomElement(array_keys($cepsPorEstado));

        // Escolhe um CEP aleatório desse estado
        $cep = $this->faker->randomElement($cepsPorEstado[$estado]);
        $cepNumeros = preg_replace('/\D/', '', $cep);

        // Buscar dados reais do CEP
        $dadosEndereco = $this->buscarDadosViaCEP($cepNumeros);

        // Se a API retornou dados, usa eles. Senão, usa cidades brasileiras reais
        if (!empty($dadosEndereco) && !isset($dadosEndereco['erro'])) {
            $cidade = $dadosEndereco['localidade'];
            $rua = $dadosEndereco['logradouro'];
            $estado = $dadosEndereco['uf'];
        } else {
            // Lista de cidades brasileiras reais por estado
            $cidadesPorEstado = $this->getCidadesBrasileiras();
            $cidade = $this->faker->randomElement($cidadesPorEstado[$estado] ?? ['Cidade Desconhecida']);
            $rua = $this->faker->streetName();
        }

        return [
            'nome' => $this->gerarNomePontoColeta($cidade),
            'rua' => $rua,
            'numero' => $this->faker->optional(0.8)->buildingNumber(), // 80% tem número, 20% não
            'cep' => $cepNumeros,
            'cidade' => $cidade,
            'estado' => $estado,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Busca dados reais do endereço via API ViaCEP
     */
    private function buscarDadosViaCEP(string $cep): array
    {
        try {
            $url = "https://viacep.com.br/ws/{$cep}/json/";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && $response) {
                $dados = json_decode($response, true);
                return $dados;
            }
        } catch (\Exception $e) {
            // Em caso de erro, retorna array vazio
        }

        return [];
    }

    /**
     * Gera nomes realistas para pontos de coleta
     */
    private function gerarNomePontoColeta(string $cidade): string
    {
        $prefixos = [
            'Ponto de Coleta',
            'Ecoponto',
            'Centro de Reciclagem',
            'Posto de Coleta Seletiva',
            'Estação de Recicláveis',
            'Ponto Verde',
            'Ecoestação',
        ];

        $sufixos = [
            'Central',
            'Comunitário',
            'Municipal',
            'do Bairro',
            'Verde',
            'Ecológico',
            'Sustentável',
        ];

        $tipos = [
            'Shopping',
            'Supermercado',
            'Praça',
            'Parque',
            'Centro',
            'Terminal',
        ];

        return sprintf(
            '%s %s - %s',
            $this->faker->randomElement($prefixos),
            $this->faker->randomElement($tipos),
            $cidade
        );
    }

    /**
     * Retorna lista de cidades brasileiras reais por estado
     */
    private function getCidadesBrasileiras(): array
    {
        return [
            'AC' => ['Rio Branco', 'Cruzeiro do Sul', 'Sena Madureira'],
            'AL' => ['Maceió', 'Arapiraca', 'Palmeira dos Índios'],
            'AP' => ['Macapá', 'Santana', 'Laranjal do Jari'],
            'AM' => ['Manaus', 'Parintins', 'Itacoatiara'],
            'BA' => ['Salvador', 'Feira de Santana', 'Vitória da Conquista'],
            'CE' => ['Fortaleza', 'Caucaia', 'Juazeiro do Norte'],
            'DF' => ['Brasília'],
            'ES' => ['Vitória', 'Vila Velha', 'Cariacica'],
            'GO' => ['Goiânia', 'Anápolis', 'Luziânia'],
            'MA' => ['São Luís', 'Imperatriz', 'Timon'],
            'MT' => ['Cuiabá', 'Várzea Grande', 'Rondonópolis'],
            'MS' => ['Campo Grande', 'Dourados', 'Três Lagoas'],
            'MG' => ['Belo Horizonte', 'Uberlândia', 'Contagem'],
            'PA' => ['Belém', 'Ananindeua', 'Santarém'],
            'PB' => ['João Pessoa', 'Campina Grande', 'Santa Rita'],
            'PR' => ['Curitiba', 'Londrina', 'Maringá'],
            'PE' => ['Recife', 'Jaboatão dos Guararapes', 'Olinda'],
            'PI' => ['Teresina', 'Parnaíba', 'Picos'],
            'RJ' => ['Rio de Janeiro', 'São Gonçalo', 'Duque de Caxias'],
            'RN' => ['Natal', 'Mossoró', 'Parnamirim'],
            'RS' => ['Porto Alegre', 'Caxias do Sul', 'Pelotas'],
            'RO' => ['Porto Velho', 'Ji-Paraná', 'Ariquemes'],
            'RR' => ['Boa Vista', 'Rorainópolis', 'Caracaraí'],
            'SC' => ['Florianópolis', 'Joinville', 'Blumenau'],
            'SP' => ['São Paulo', 'Guarulhos', 'Campinas', 'Votuporanga', 'São José do Rio Preto'],
            'SE' => ['Aracaju', 'Nossa Senhora do Socorro', 'Lagarto'],
            'TO' => ['Palmas', 'Araguaína', 'Gurupi'],
        ];
    }
}
