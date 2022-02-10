<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_status')->insert([
            'descricao' => 'Pedido pendente',
            'fluxo' => 'RETIRAR',
            'ordem' => 1,
        ]);
        DB::table('tb_status')->insert([
            'descricao' => 'Pedido aceito',
            'fluxo' => 'RETIRAR',
            'ordem' => 2,
        ]);
        DB::table('tb_status')->insert([
            'descricao' => 'Separação concluida',
            'fluxo' => 'RETIRAR',
            'ordem' => 3,
        ]);
        DB::table('tb_status')->insert([
            'descricao' => 'Aguardando Retirada',
            'fluxo' => 'RETIRAR',
            'ordem' => 4,
        ]);
        DB::table('tb_status')->insert([
            'descricao' => 'Pedido Concluido',
            'fluxo' => 'RETIRAR',
            'ordem' => 5,
        ]);
        DB::table('tb_status')->insert([
            'descricao' => 'Pedido Cancelado',
            'fluxo' => 'RETIRAR',
            'ordem' => 6,
        ]);


        DB::table('tb_status')->insert([
            'descricao' => 'Pedido pendente',
            'fluxo' => 'RECEBER',
            'ordem' => 1,
        ]);
        DB::table('tb_status')->insert([
            'descricao' => 'Pedido aceito',
            'fluxo' => 'RECEBER',
            'ordem' => 2,
        ]);
        DB::table('tb_status')->insert([
            'descricao' => 'Separação concluida',
            'fluxo' => 'RECEBER',
            'ordem' => 3,
        ]);

        DB::table('tb_status')->insert([
            'descricao' => 'Saiu para entrega',
            'fluxo' => 'RECEBER',
            'ordem' => 4,
        ]);

        DB::table('tb_status')->insert([
            'descricao' => 'Aguardando no local',
            'fluxo' => 'RECEBER',
            'ordem' => 5,
        ]);

        DB::table('tb_status')->insert([
            'descricao' => 'Pedido Concluido',
            'fluxo' => 'RECEBER',
            'ordem' => 6,
        ]);

        DB::table('tb_status')->insert([
            'descricao' => 'Pedido Cancelado',
            'fluxo' => 'RECEBER',
            'ordem' => 7,
        ]);
    }
}
