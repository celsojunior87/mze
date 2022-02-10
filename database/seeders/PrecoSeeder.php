<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Regiao_id 7
        DB::table('tb_precos')->insert([
            "preco" => 4.59,
            "perc_comisao" => 10,
            "valor_comisao" => 0.15,
            "regioes_id" => 7,
            "produtos_id" => 1
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.09,
            "regioes_id" => 7,
            "produtos_id" => 2
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 24.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.72,
            "regioes_id" => 7,
            "produtos_id" => 3
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.21,
            "regioes_id" => 7,
            "produtos_id" => 4
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.20,
            "regioes_id" => 7,
            "produtos_id" => 5
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.15,
            "regioes_id" => 7,
            "produtos_id" => 6
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 9.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.31,
            "regioes_id" => 7,
            "produtos_id" => 7
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.16,
            "regioes_id" => 7,
            "produtos_id" => 8
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 9.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.26,
            "regioes_id" => 7,
            "produtos_id" => 9
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.47,
            "regioes_id" => 7,
            "produtos_id" => 10
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.14,
            "regioes_id" => 7,
            "produtos_id" => 11
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.39,
            "regioes_id" => 7,
            "produtos_id" => 12
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.59,
            "perc_comisao" => 10,
            "valor_comisao" => 0.15,
            "regioes_id" => 7,
            "produtos_id" => 13
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.85,
            "perc_comisao" => 10,
            "valor_comisao" => 0.06,
            "regioes_id" => 7,
            "produtos_id" => 14
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.20,
            "regioes_id" => 7,
            "produtos_id" => 15
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.37,
            "regioes_id" => 7,
            "produtos_id" => 16
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.19,
            "regioes_id" => 7,
            "produtos_id" => 17
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 1.19,
            "perc_comisao" => 10,
            "valor_comisao" => 0.04,
            "regioes_id" => 7,
            "produtos_id" => 18
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.24,
            "regioes_id" => 7,
            "produtos_id" => 19
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.23,
            "regioes_id" => 7,
            "produtos_id" => 20
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.13,
            "regioes_id" => 7,
            "produtos_id" => 21
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.09,
            "regioes_id" => 7,
            "produtos_id" => 22
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.07,
            "regioes_id" => 7,
            "produtos_id" => 23
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 22.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.80,
            "regioes_id" => 7,
            "produtos_id" => 24
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.46,
            "regioes_id" => 7,
            "produtos_id" => 25
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 5.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.09,
            "regioes_id" => 7,
            "produtos_id" => 26
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.10,
            "regioes_id" => 7,
            "produtos_id" => 27
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 11.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.37,
            "regioes_id" => 7,
            "produtos_id" => 28
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 5.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.17,
            "regioes_id" => 7,
            "produtos_id" => 29
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 1.19,
            "perc_comisao" => 10,
            "valor_comisao" => 0.04,
            "regioes_id" => 7,
            "produtos_id" => 30
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 5.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.02,
            "regioes_id" => 7,
            "produtos_id" => 31
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.11,
            "regioes_id" => 7,
            "produtos_id" => 32
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.22,
            "regioes_id" => 7,
            "produtos_id" => 33
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.21,
            "regioes_id" => 7,
            "produtos_id" => 34
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.13,
            "regioes_id" => 7,
            "produtos_id" => 35
        ]);

        //regiao_id 28

        DB::table('tb_precos')->insert([
            "preco" => 4.59,
            "perc_comisao" => 10,
            "valor_comisao" => 0.15,
            "regioes_id" => 28,
            "produtos_id" => 1
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.09,
            "regioes_id" => 28,
            "produtos_id" => 2
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 24.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.72,
            "regioes_id" => 28,
            "produtos_id" => 3
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.21,
            "regioes_id" => 28,
            "produtos_id" => 4
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.20,
            "regioes_id" => 28,
            "produtos_id" => 5
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.15,
            "regioes_id" => 28,
            "produtos_id" => 6
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 9.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.31,
            "regioes_id" => 28,
            "produtos_id" => 7
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.16,
            "regioes_id" => 28,
            "produtos_id" => 8
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 9.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.26,
            "regioes_id" => 28,
            "produtos_id" => 9
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.47,
            "regioes_id" => 28,
            "produtos_id" => 10
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.14,
            "regioes_id" => 28,
            "produtos_id" => 11
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.39,
            "regioes_id" => 28,
            "produtos_id" => 12
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.59,
            "perc_comisao" => 10,
            "valor_comisao" => 0.15,
            "regioes_id" => 28,
            "produtos_id" => 13
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.85,
            "perc_comisao" => 10,
            "valor_comisao" => 0.06,
            "regioes_id" => 28,
            "produtos_id" => 14
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.20,
            "regioes_id" => 28,
            "produtos_id" => 15
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.37,
            "regioes_id" => 28,
            "produtos_id" => 16
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.19,
            "regioes_id" => 28,
            "produtos_id" => 17
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 1.19,
            "perc_comisao" => 10,
            "valor_comisao" => 0.04,
            "regioes_id" => 28,
            "produtos_id" => 18
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.24,
            "regioes_id" => 28,
            "produtos_id" => 19
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.23,
            "regioes_id" => 28,
            "produtos_id" => 20
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.13,
            "regioes_id" => 28,
            "produtos_id" => 21
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.09,
            "regioes_id" => 28,
            "produtos_id" => 22
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.07,
            "regioes_id" => 28,
            "produtos_id" => 23
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 22.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.80,
            "regioes_id" => 28,
            "produtos_id" => 24
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.46,
            "regioes_id" => 28,
            "produtos_id" => 25
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 5.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.09,
            "regioes_id" => 28,
            "produtos_id" => 26
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.10,
            "regioes_id" => 28,
            "produtos_id" => 27
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 11.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.37,
            "regioes_id" => 28,
            "produtos_id" => 28
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 5.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.17,
            "regioes_id" => 28,
            "produtos_id" => 29
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 1.19,
            "perc_comisao" => 10,
            "valor_comisao" => 0.04,
            "regioes_id" => 28,
            "produtos_id" => 30
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 5.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.02,
            "regioes_id" => 28,
            "produtos_id" => 31
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.11,
            "regioes_id" => 28,
            "produtos_id" => 32
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.22,
            "regioes_id" => 28,
            "produtos_id" => 33
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.21,
            "regioes_id" => 28,
            "produtos_id" => 34
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.13,
            "regioes_id" => 28,
            "produtos_id" => 35
        ]);

        //regiao_id 29

        DB::table('tb_precos')->insert([
            "preco" => 4.59,
            "perc_comisao" => 10,
            "valor_comisao" => 0.15,
            "regioes_id" => 29,
            "produtos_id" => 1
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.09,
            "regioes_id" => 29,
            "produtos_id" => 2
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 24.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.72,
            "regioes_id" => 29,
            "produtos_id" => 3
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.21,
            "regioes_id" => 29,
            "produtos_id" => 4
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.20,
            "regioes_id" => 29,
            "produtos_id" => 5
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.15,
            "regioes_id" => 29,
            "produtos_id" => 6
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 9.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.31,
            "regioes_id" => 29,
            "produtos_id" => 7
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.16,
            "regioes_id" => 29,
            "produtos_id" => 8
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 9.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.26,
            "regioes_id" => 29,
            "produtos_id" => 9
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.47,
            "regioes_id" => 29,
            "produtos_id" => 10
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.14,
            "regioes_id" => 29,
            "produtos_id" => 11
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.39,
            "regioes_id" => 29,
            "produtos_id" => 12
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.59,
            "perc_comisao" => 10,
            "valor_comisao" => 0.15,
            "regioes_id" => 29,
            "produtos_id" => 13
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.85,
            "perc_comisao" => 10,
            "valor_comisao" => 0.06,
            "regioes_id" => 29,
            "produtos_id" => 14
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.20,
            "regioes_id" => 29,
            "produtos_id" => 15
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.37,
            "regioes_id" => 29,
            "produtos_id" => 16
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.19,
            "regioes_id" => 29,
            "produtos_id" => 17
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 1.19,
            "perc_comisao" => 10,
            "valor_comisao" => 0.04,
            "regioes_id" => 29,
            "produtos_id" => 18
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.24,
            "regioes_id" => 29,
            "produtos_id" => 19
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.23,
            "regioes_id" => 29,
            "produtos_id" => 20
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.13,
            "regioes_id" => 29,
            "produtos_id" => 21
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.09,
            "regioes_id" => 29,
            "produtos_id" => 22
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.07,
            "regioes_id" => 29,
            "produtos_id" => 23
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 22.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.80,
            "regioes_id" => 29,
            "produtos_id" => 24
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 12.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.46,
            "regioes_id" => 29,
            "produtos_id" => 25
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 5.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.09,
            "regioes_id" => 29,
            "produtos_id" => 26
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.39,
            "perc_comisao" => 10,
            "valor_comisao" => 0.10,
            "regioes_id" => 29,
            "produtos_id" => 27
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 11.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.37,
            "regioes_id" => 29,
            "produtos_id" => 28
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 5.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.17,
            "regioes_id" => 29,
            "produtos_id" => 29
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 1.19,
            "perc_comisao" => 10,
            "valor_comisao" => 0.04,
            "regioes_id" => 29,
            "produtos_id" => 30
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 5.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.02,
            "regioes_id" => 29,
            "produtos_id" => 31
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 3.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.11,
            "regioes_id" => 29,
            "produtos_id" => 32
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 7.49,
            "perc_comisao" => 10,
            "valor_comisao" => 0.22,
            "regioes_id" => 29,
            "produtos_id" => 33
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 6.79,
            "perc_comisao" => 10,
            "valor_comisao" => 0.21,
            "regioes_id" => 29,
            "produtos_id" => 34
        ]);
        DB::table('tb_precos')->insert([
            "preco" => 4.99,
            "perc_comisao" => 10,
            "valor_comisao" => 0.13,
            "regioes_id" => 29,
            "produtos_id" => 35
        ]);
    }
}
