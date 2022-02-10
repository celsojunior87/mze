<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tb_departamentos')->insert([
            'descricao' => 'Bebidas',
            'url' => 'mze-departamentos/bebidas.png'
        ]);

        DB::table('tb_departamentos')->insert([
            'descricao' => 'Descartáveis',
            'url' => 'mze-departamentos/descartaveis.png'
        ]);

        DB::table('tb_departamentos')->insert([
            'descricao' => 'Higiene e beleza',
            'url' => 'mze-departamentos/higiene-pessoal.png'
        ]);

        DB::table('tb_departamentos')->insert([
            'descricao' => 'Limpeza',
            'url' => 'mze-departamentos/limpeza.png'
        ]);

        DB::table('tb_departamentos')->insert([
            'descricao' => 'Mercearia',
            'url' => 'mze-departamentos/mercearia.png'
        ]);

        DB::table('tb_departamentos')->insert([
            'descricao' => 'Pets',
            'url' => 'mze-departamentos/petz.png'
        ]);
    }
}
