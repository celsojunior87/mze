<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCobrancasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_tipos_cobrancas')->insert([
            'descricao' => 'Cartão de Crédito',

        ]);

        DB::table('tb_tipos_cobrancas')->insert([
            'descricao' => 'Cartão de Débito',
        ]);

        DB::table('tb_tipos_cobrancas')->insert([
            'descricao' => 'Pix',
        ]);
    }
}
