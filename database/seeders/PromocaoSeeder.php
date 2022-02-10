<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //regiao 7
        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Becker',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-bekes-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 7,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Bohemia',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-bohemia-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 7,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Brahma',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-bramosidade-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 7,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Cervejas',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-cervejas-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 7,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Colorado',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-colorado-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 7,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Guaraná Antartica',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-guarana-440X240.png",
            'tipo' => 'valor',
            'regioes_id' => 7,
        ]);

        //regiao 28
        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Becker',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-bekes-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 28,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Bohemia',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-bohemia-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 28,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Brahma',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-bramosidade-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 28,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Cervejas',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-cervejas-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 28,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Colorado',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-colorado-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 28,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Guaraná Antartica',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-guarana-440X240.png",
            'tipo' => 'valor',
            'regioes_id' => 28,
        ]);


        //regiao 29
        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Becker',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-bekes-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 29,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Bohemia',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-bohemia-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 29,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Brahma',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-bramosidade-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 29,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Cervejas',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-cervejas-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 29,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Colorado',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-colorado-440x240.png",
            'tipo' => 'valor',
            'regioes_id' => 29,
        ]);

        DB::table('tb_promocoes')->insert([
            'descricao' => 'Promoção de Guaraná Antartica',
            'dt_inicial' => Carbon::now(),
            'dt_final' => Carbon::now(),
            'url_imagem' => "mze-promocao/promocao-guarana-440X240.png",
            'tipo' => 'valor',
            'regioes_id' => 29,
        ]);
    }
}
