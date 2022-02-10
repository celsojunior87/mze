<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParametroPresidencialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tb_parametros_presidencias')->insert([
            'nome' => 'raio',
            'aplicacao' => 'APP-SOCIO',
            'descricao' => 'Raio',
            'valor' => '5.00'
        ]);

        DB::table('tb_parametros_presidencias')->insert([
            'nome' => 'base_url_storage',
            'aplicacao' => 'APP-CLIENTE',
            'descricao' => 'Base Url Storage',
            'valor' => 'https://api.mercadinhodoze.com.br/storage/'
        ]);
    }
}
