<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('steps')->insert([
            [
                'name' => 'Busca e priorização dos leads',
                'description' => 'É o momento de identificar e selecionar potenciais clientes que tenham o perfil adequado para o seu negócio. Isso é fundamental para garantir que o processo de prospecção seja eficiente e bem direcionado, evitando perda de tempo e recursos com leads desqualificados que não têm real interesse na sua solução.',
                'color' => '#6610f2',
                'sequence' => 1,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Pesquisa, estudo e preparação',
                'description' => 'Nessa etapa, o objetivo é conhecer o máximo possível sobre os leads selecionados na primeira fase, buscando entender suas necessidades, desafios, preferências e comportamentos. Isso é fundamental para que a abordagem na etapa seguinte seja mais eficiente e personalizada, aumentando as chances de conversão.',
                'color' => '#17a2b8',
                'sequence' => 2,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Primeiro contato/apresentação',
                'description' => 'Essa etapa é essencial para estabelecer o primeiro contato entre o vendedor e o potencial cliente, apresentando a solução oferecida pela empresa de forma clara e objetiva. O objetivo é gerar interesse e curiosidade no lead, abrindo caminho para a próxima etapa do processo de prospecção.',
                'color' => '#007bff',
                'sequence' => 3,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Qualificação',
                'description' => 'Consiste em avaliar se o lead realmente possui potencial para se tornar um cliente efetivo. Nessa etapa, é importante entender se ele tem a necessidade e a capacidade financeira para adquirir a solução oferecida pela sua empresa, além de avaliar se ele está verdadeiramente disposto a seguir adiante no processo de compra.',
                'color' => '#28a745',
                'sequence' => 4,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Nutrição',
                'description' => 'Consiste em manter e fortalecer o relacionamento com os seus clientes por meio de conteúdos relevantes e educativos. Essa etapa é importante para manter o interesse e o engajamento do lead na solução oferecida pela sua empresa, reforçando o relacionamento e construindo confiança a longo prazo.',
                'color' => '#ffc107',
                'sequence' => 5,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Diagnóstico',
                'description' => 'Consiste em entender profundamente as necessidades e desafios do lead, identificando as soluções que melhor atendem às suas demandas. Essa etapa é fundamental para que a empresa possa oferecer a solução mais adequada e eficiente para o cliente, garantindo a sua satisfação e fidelização.',
                'color' => '#ff851b',
                'sequence' => 6,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Apresentação e Propósta',
                'description' => 'onsiste em mostrar ao lead a solução mais adequada para as suas necessidades, apresentando o valor que será entregue e o retorno que ele poderá esperar da sua empresa. Essa etapa é importante porque é quando o cliente avalia as diferentes opções e toma uma decisão de compra.',
                'color' => '#dc3545',
                'sequence' => 7,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Follow-Up',
                'description' => 'Consiste em dar continuidade à negociação e manter contato com o lead após a apresentação de proposta. Essa etapa é importante porque, muitas vezes, o cliente pode precisar de mais tempo para avaliar a proposta ou ter algum imprevisto no processo de compra. Portanto, é necessário manter um canal de comunicação com ele e estar sempre disponível para esclarecer dúvidas e oferecer suporte.',
                'color' => '#3d9970',
                'sequence' => 8,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Fechamento',
                'description' => 'É  o momento em que o lead decide comprar (ou não) a solução oferecida. Essa etapa é a mais importante do processo, pois é quando o trabalho de prospecção se concretiza em resultados e receita para a empresa.',
                'color' => '#6c757d',
                'sequence' => 9,
                'created_at' => new \DateTime('now'),
            ],
        ]);
    }
}
