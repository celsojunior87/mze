<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnderecoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_enderecos_clientes')->insert([
            "clientes_id" => 1,
            "enderecos_id" => 8,
        ]);

        DB::table('tb_enderecos_clientes')->insert([
            "clientes_id" => 2,
            "enderecos_id" => 9,
        ]);

        DB::table('tb_enderecos_clientes')->insert([
            "clientes_id" => 3,
            "enderecos_id" => 10,
        ]);

        DB::table('tb_enderecos_clientes')->insert([
            "clientes_id" => 4,
            "enderecos_id" => 11,
        ]);

        DB::table('tb_enderecos_clientes')->insert([
            "clientes_id" => 5,
            "enderecos_id" => 12,
        ]);

        DB::table('tb_enderecos_clientes')->insert([
            "clientes_id" => 6,
            "enderecos_id" => 13,
        ]);

        DB::table('tb_enderecos_clientes')->insert([
            "clientes_id" => 7,
            "enderecos_id" => 14,
        ]);
    }
}
