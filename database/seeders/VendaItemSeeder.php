<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Traits\VendaUtilitarios;

class VendaItemSeeder extends Seeder
{
    use VendaUtilitarios;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_vendas_itens')->insert([
            'qt_pedida' => 5,
            'qt_atendida' => 0,
            'valor' => 4.59,
            'vl_desconto' => 0.00,
            'perc_desc' => 0.00,
            'perc_comissao' => 10,
            'vl_comissao' => 0.45,
            'vendas_id' => 1,
            'produtos_id' => 1
        ]);

        DB::table('tb_vendas_itens')->insert([
            'qt_pedida' => 3,
            'qt_atendida' => 0,
            'valor' => 3.79,
            'vl_desconto' => 0.00,
            'perc_desc' => 0,
            'perc_comissao' => 10,
            'vl_comissao' => 0.27,
            'vendas_id' => 1,
            'produtos_id' => 2,
        ]);

        $venda_id = 1;
        $this->encontraVendedores($venda_id);

        DB::table('tb_vendas_itens')->insert([
            'qt_pedida' => 3,
            'qt_atendida' => 0,
            'valor' => 4.59,
            'vl_desconto' => 0.00,
            'perc_desc' => 0.00,
            'perc_comissao' => 10,
            'vl_comissao' => 0.45,
            'vendas_id' => 2,
            'produtos_id' => 1
        ]);

        DB::table('tb_vendas_itens')->insert([
            'qt_pedida' => 1,
            'qt_atendida' => 0,
            'valor' => 3.79,
            'vl_desconto' => 0.00,
            'perc_desc' => 0,
            'perc_comissao' => 10,
            'vl_comissao' => 0.27,
            'vendas_id' => 2,
            'produtos_id' => 2,
        ]);

        $venda_id = 2;
        $this->encontraVendedores($venda_id);
    }
}
