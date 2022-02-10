<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegiaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_regioes')->insert([
            ['descricao' => 'Região Padrão AC', 'latitude' => '-8.77', 'longitude' => '-70.55', 'raio_entrega' => '60', 'estados_id' => 1],
            ['descricao' => 'Região Padrão AL', 'latitude' => '-9.71', 'longitude' => '-35.73', 'raio_entrega' => '60', 'estados_id' => 2],
            ['descricao' => 'Região Padrão AM', 'latitude' => '-3.07', 'longitude' => '-61.66', 'raio_entrega' => '60', 'estados_id' => 4],
            ['descricao' => 'Região Padrão AP', 'latitude' => '1.41', 'longitude' => '-51.77', 'raio_entrega' => '60', 'estados_id' => 3],
            ['descricao' => 'Região Padrão BA', 'latitude' => '-12.96', 'longitude' => '-38.51', 'raio_entrega' => '60', 'estados_id' => 5],
            ['descricao' => 'Região Padrão CE', 'latitude' => '-3.71', 'longitude' => '-38.54', 'raio_entrega' => '60', 'estados_id' => 6],
            ['descricao' => 'Região Padrão DF', 'latitude' => '-15.83', 'longitude' => '-47.86', 'raio_entrega' => '60', 'estados_id' => 7],
            ['descricao' => 'Região Padrão ES', 'latitude' => '-19.19', 'longitude' => '-40.34', 'raio_entrega' => '60', 'estados_id' => 8],
            ['descricao' => 'Região Padrão GO', 'latitude' => '-16.64', 'longitude' => '-49.31', 'raio_entrega' => '60', 'estados_id' => 9],
            ['descricao' => 'Região Padrão MA', 'latitude' => '-2.55', 'longitude' => '-44.30', 'raio_entrega' => '60', 'estados_id' => 10],
            ['descricao' => 'Região Padrão MT', 'latitude' => '-12.64', 'longitude' => '-55.42', 'raio_entrega' => '60', 'estados_id' => 11],
            ['descricao' => 'Região Padrão MS', 'latitude' => '-20.51', 'longitude' => '-54.54', 'raio_entrega' => '60', 'estados_id' => 12],
            ['descricao' => 'Região Padrão MG', 'latitude' => '-18.10', 'longitude' => '-44.38', 'raio_entrega' => '60', 'estados_id' => 13],
            ['descricao' => 'Região Padrão PA', 'latitude' => '-5.53', 'longitude' => '-52.29', 'raio_entrega' => '60', 'estados_id' => 14],
            ['descricao' => 'Região Padrão PB', 'latitude' => '-7.06', 'longitude' => '-35.55', 'raio_entrega' => '60', 'estados_id' => 15],
            ['descricao' => 'Região Padrão PR', 'latitude' => '-24.89', 'longitude' => '-51.55', 'raio_entrega' => '60', 'estados_id' => 16],
            ['descricao' => 'Região Padrão PE', 'latitude' => '-8.28', 'longitude' => '-35.07', 'raio_entrega' => '60', 'estados_id' => 17],
            ['descricao' => 'Região Padrão PI', 'latitude' => '-8.28', 'longitude' => '-43.68', 'raio_entrega' => '60', 'estados_id' => 18],
            ['descricao' => 'Região Padrão RJ', 'latitude' => '-22.84', 'longitude' => '-43.15', 'raio_entrega' => '60', 'estados_id' => 19],
            ['descricao' => 'Região Padrão RN', 'latitude' => '-5.22', 'longitude' => '-36.52', 'raio_entrega' => '60', 'estados_id' => 20],
            ['descricao' => 'Região Padrão RO', 'latitude' => '-11.22', 'longitude' => '-62.80', 'raio_entrega' => '60', 'estados_id' => 22],
            ['descricao' => 'Região Padrão RS', 'latitude' => '-30.01', 'longitude' => '-51.22', 'raio_entrega' => '60', 'estados_id' => 21],
            ['descricao' => 'Região Padrão RR', 'latitude' => '1.89', 'longitude' => '-61.22', 'raio_entrega' => '60', 'estados_id' => 23],
            ['descricao' => 'Região Padrão SC', 'latitude' => '-27.33', 'longitude' => '-49.44', 'raio_entrega' => '60', 'estados_id' => 24],
            ['descricao' => 'Região Padrão SE', 'latitude' => '-10.90', 'longitude' => '-37.07', 'raio_entrega' => '60', 'estados_id' => 26],
            ['descricao' => 'Região Padrão SP', 'latitude' => '-23.55', 'longitude' => '-46.64', 'raio_entrega' => '60', 'estados_id' => 25],
            ['descricao' => 'Região Padrão TO', 'latitude' => '-10.25', 'longitude' => '-48.25', 'raio_entrega' => '60', 'estados_id' => 27],
            [
                'descricao' => 'Guará',
                'latitude' => '-15.812287357974718',
                'longitude' => '-47.97605494894776',
                'raio_entrega' => '6',
                'estados_id' => 7
            ],
            [
                'descricao' => 'Águas Claras',
                'latitude' => '-15.83484467680237',
                'longitude' => '-48.02582547831073',
                'raio_entrega' => '2',
                'estados_id' => 7
            ],
            [
                'descricao' => 'Vicente Pires',
                'latitude' => '-15.802261256990592',
                'longitude' => '-48.03087978931728',
                'raio_entrega' => '3',
                'estados_id' => 7
            ],
            [
                'descricao' => 'Ceilândia',
                'latitude' => '-25.804714037433321',
                'longitude' => '-48.1145601615827',
                'raio_entrega' => '5',
                'estados_id' => 7
            ],
            [
                'descricao' => 'Asa Norte',
                'latitude' => '-15.758619340637912',
                'longitude' => '-47.89736030782133',
                'raio_entrega' => '3.5',
                'estados_id' => 7
            ]
        ]);

        $estados = Estado::all();

        foreach ($estados as $estado) {
            $estado->update(['regiao_padrao_id' => $estado->id]);
        }
    }
}
