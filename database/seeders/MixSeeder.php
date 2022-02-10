<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_mix')->insert([
            ['titulo' => 'Mix Padrão AC', 'descricao' => 'Mix da Região Padrão AC', 'regioes_id' => 1],
            ['titulo' => 'Mix Padrão AL', 'descricao' => 'Mix da Região Padrão AL', 'regioes_id' => 2],
            ['titulo' => 'Mix Padrão AM', 'descricao' => 'Mix da Região Padrão AM', 'regioes_id' => 4],
            ['titulo' => 'Mix Padrão AP', 'descricao' => 'Mix da Região Padrão AP', 'regioes_id' => 3],
            ['titulo' => 'Mix Padrão BA', 'descricao' => 'Mix da Região Padrão BA', 'regioes_id' => 5],
            ['titulo' => 'Mix Padrão CE', 'descricao' => 'Mix da Região Padrão CE', 'regioes_id' => 6],
            ['titulo' => 'Mix Padrão DF', 'descricao' => 'Mix da Região Padrão DF', 'regioes_id' => 7],
            ['titulo' => 'Mix Padrão ES', 'descricao' => 'Mix da Região Padrão ES', 'regioes_id' => 8],
            ['titulo' => 'Mix Padrão GO', 'descricao' => 'Mix da Região Padrão GO', 'regioes_id' => 9],
            ['titulo' => 'Mix Padrão MA', 'descricao' => 'Mix da Região Padrão MA', 'regioes_id' => 10],
            ['titulo' => 'Mix Padrão MT', 'descricao' => 'Mix da Região Padrão MT', 'regioes_id' => 11],
            ['titulo' => 'Mix Padrão MS', 'descricao' => 'Mix da Região Padrão MS', 'regioes_id' => 12],
            ['titulo' => 'Mix Padrão MG', 'descricao' => 'Mix da Região Padrão MG', 'regioes_id' => 13],
            ['titulo' => 'Mix Padrão PA', 'descricao' => 'Mix da Região Padrão PA', 'regioes_id' => 14],
            ['titulo' => 'Mix Padrão PB', 'descricao' => 'Mix da Região Padrão PB', 'regioes_id' => 15],
            ['titulo' => 'Mix Padrão PR', 'descricao' => 'Mix da Região Padrão PR', 'regioes_id' => 16],
            ['titulo' => 'Mix Padrão PE', 'descricao' => 'Mix da Região Padrão PE', 'regioes_id' => 17],
            ['titulo' => 'Mix Padrão PI', 'descricao' => 'Mix da Região Padrão PI', 'regioes_id' => 18],
            ['titulo' => 'Mix Padrão RJ', 'descricao' => 'Mix da Região Padrão RJ', 'regioes_id' => 19],
            ['titulo' => 'Mix Padrão RN', 'descricao' => 'Mix da Região Padrão RN', 'regioes_id' => 20],
            ['titulo' => 'Mix Padrão RO', 'descricao' => 'Mix da Região Padrão RO', 'regioes_id' => 22],
            ['titulo' => 'Mix Padrão RS', 'descricao' => 'Mix da Região Padrão RS', 'regioes_id' => 21],
            ['titulo' => 'Mix Padrão RR', 'descricao' => 'Mix da Região Padrão RR', 'regioes_id' => 23],
            ['titulo' => 'Mix Padrão SC', 'descricao' => 'Mix da Região Padrão SC', 'regioes_id' => 24],
            ['titulo' => 'Mix Padrão SE', 'descricao' => 'Mix da Região Padrão SE', 'regioes_id' => 26],
            ['titulo' => 'Mix Padrão SP', 'descricao' => 'Mix da Região Padrão SP', 'regioes_id' => 25],
            ['titulo' => 'Mix Padrão TO', 'descricao' => 'Mix da Região Padrão TO', 'regioes_id' => 27],
        ]);
    }
}
