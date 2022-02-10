<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstituicaoFinanceiraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_instituicoes_financeiras')->insert([
            'nome' => 'Banco do Brasil',
            'descricao' => 'BB',
            'codigo' => '001',

        ]);

        DB::table('tb_instituicoes_financeiras')->insert([
            'nome' => 'Bradesco',
            'descricao' => 'Bradesco S.A',
            'codigo' => '002',
        ]);


        DB::table('tb_instituicoes_financeiras')->insert([
            'nome' => 'Nubank',
            'descricao' => 'Nubank',
            'codigo' => '003',
        ]);


        DB::table('tb_instituicoes_financeiras')->insert([
            'nome' => 'Banco Original',
            'descricao' => 'Original',
            'codigo' => '004',

        ]);
    }
}
