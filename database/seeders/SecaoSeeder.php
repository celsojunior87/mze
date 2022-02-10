<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_secoes')->insert([
            'descricao' => 'Não alcóolica',
            'departamentos_id' => 1,
            'url' => 'secao/bebidas.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Alcóolica',
            'departamentos_id' => 1,
            'url' => 'secao/bebidas.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Festa',
            'departamentos_id' => 2,
            'url' => 'secao/descartaveis.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Cozinha',
            'departamentos_id' => 2,
            'url' => 'secao/descartaveis.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Cuidados pessoais',
            'departamentos_id' => 3,
            'url' => 'secao/higiene-pessoal.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Utensílios',
            'departamentos_id' => 4,
            'url' => 'secao/limpeza.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Cuidados com a casa',
            'departamentos_id' => 4,
            'url' => 'secao/limpeza.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Cuidado com a roupa',
            'departamentos_id' => 4,
            'url' => 'secao/limpeza.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Biscoito e salgadinho',
            'departamentos_id' => 5,
            'url' => 'secao/mercearia.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Alimentos básicos',
            'departamentos_id' => 5,
            'url' => 'secao/mercearia.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Leites e derivados',
            'departamentos_id' => 5,
            'url' => 'secao/mercearia.png'
        ]);

        DB::table('tb_secoes')->insert([
            'descricao' => 'Rações',
            'departamentos_id' => 6,
            'url' => 'secao/petz.png'
        ]);
    }
}
