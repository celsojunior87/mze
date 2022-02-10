<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendaSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_vendas')->insert([
            'dt_venda' => Carbon::now(),
            'vl_total' => 34.32,
            'vl_desconto' => 0,
            'retirada' => 0,
            'agendado' => 0,
            'clientes_id' => 1,
            'num_pedido' => 'C23456',
            'enderecos_id' => 7,
            'status_id' => 7,
        ]);

        DB::table('tb_vendas')->insert([
            'dt_venda' => Carbon::now(),
            'vl_total' => 17.56,
            'vl_desconto' => 0,
            'retirada' => 0,
            'agendado' => 0,
            'clientes_id' => 6,
            'num_pedido' => 'C23456',
            'enderecos_id' => 7,
            'status_id' => 7,
        ]);
    }
}
