<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_estados')->insert([
            ['uf' => 'AC'],
            ['uf' => 'AL'],
            ['uf' => 'AP'],
            ['uf' => 'AM'],
            ['uf' => 'BA'],
            ['uf' => 'CE'],
            ['uf' => 'DF'],
            ['uf' => 'ES'],
            ['uf' => 'GO'],
            ['uf' => 'MA'],
            ['uf' => 'MT'],
            ['uf' => 'MS'],
            ['uf' => 'MG'],
            ['uf' => 'PA'],
            ['uf' => 'PB'],
            ['uf' => 'PR'],
            ['uf' => 'PE'],
            ['uf' => 'PI'],
            ['uf' => 'RJ'],
            ['uf' => 'RN'],
            ['uf' => 'RS'],
            ['uf' => 'RO'],
            ['uf' => 'RR'],
            ['uf' => 'SC'],
            ['uf' => 'SP'],
            ['uf' => 'SE'],
            ['uf' => 'TO'],
        ]);
    }
}
