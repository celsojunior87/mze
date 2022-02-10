<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CobrancaClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tb_cobrancas_clientes')->insert([
            "tipos_cobrancas_id" => 1,
            "descricao" => "CARTÃO DE CRÉDITO",
            "numero_cartao" => "9999999999999999",
            "dt_vencimento" => "2050-12-30",
            "dt_ultima_atualizacao" => "2021-01-05",
            "titular" => "CLIENTE FINAL",
            "cgc" => "99999999999",
            "endereco" => "ENDERECO CLIENTE FINAL",
            "clientes_id" => 1
        ]);

        DB::table('tb_cobrancas_clientes')->insert([
            "tipos_cobrancas_id" => 2,
            "descricao" => "CARTÃO DE DEBITO",
            "numero_cartao" => "9999999999999999",
            "dt_vencimento" => "2050-12-30",
            "dt_ultima_atualizacao" => "2021-01-05",
            "titular" => "CLIENTE FINAL",
            "cgc" => "99999999999",
            "endereco" => "ENDERECO CLIENTE FINAL",
            "clientes_id" => 1
        ]);

        DB::table('tb_cobrancas_clientes')->insert([

            "tipos_cobrancas_id" => 1,
            "descricao" => "meu cartao visa",
            "numero_cartao" => "5471987563255522",
            "dt_vencimento" => "2021-05-06",
            "dt_ultima_atualizacao" => "2021-01-05",
            "titular" => "celso da silva couto junior",
            "cgc" => "5616516556156",
            "endereco" => "qe 01 bloco g apt 315",
            "clientes_id" => 1

        ]);

        DB::table('tb_cobrancas_clientes')->insert([

            "tipos_cobrancas_id" => 1,
            "descricao" => "meu cartao visa",
            "numero_cartao" => "5471987563255522",
            "dt_vencimento" => "2021-05-06",
            "dt_ultima_atualizacao" => "2021-01-05",
            "titular" => "celso da silva couto junior",
            "cgc" => "5616516556156",
            "endereco" => "qe 01 bloco g apt 315",
            "clientes_id" => 1

        ]);
    }
}
