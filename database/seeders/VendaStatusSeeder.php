<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendaStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //vendas id 1
        DB::table('tb_vendas_status')->insert([
            'ativo' => 1,
            'dt_atualizacao' => Carbon::now(),
            'status_id' => 7,
            'vendas_id' => 1,
        ]);
        for ($i = 8; $i < 14; $i++) {
            DB::table('tb_vendas_status')->insert([
                'ativo' => 1,
                'dt_atualizacao' => null,
                'status_id' => $i,
                'vendas_id' => 1,
            ]);
        }

        //vendas id 2
        DB::table('tb_vendas_status')->insert([
            'ativo' => 1,
            'dt_atualizacao' => Carbon::now(),
            'status_id' => 7,
            'vendas_id' => 2,
        ]);
        for ($i = 8; $i < 14; $i++) {
            DB::table('tb_vendas_status')->insert([
                'ativo' => 1,
                'dt_atualizacao' => null,
                'status_id' => $i,
                'vendas_id' => 2,
            ]);
        }
    }
}
