<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstoqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seed Socio Dev
        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 1,
            "filiais_id" => 1
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 20,
            "produtos_id" => 2,
            "filiais_id" => 1
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 30,
            "produtos_id" => 3,
            "filiais_id" => 1
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 4,
            "filiais_id" => 1
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 1,
            "produtos_id" => 5,
            "filiais_id" => 1
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 14,
            "filiais_id" => 1
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 28,
            "filiais_id" => 1
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 31,
            "filiais_id" => 1
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 22,
            "produtos_id" => 32,
            "filiais_id" => 1
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 34,
            "filiais_id" => 1
        ]);

        //Seed Socio Igor
        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 1,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 20,
            "produtos_id" => 2,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 30,
            "produtos_id" => 3,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 4,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 1,
            "produtos_id" => 5,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 0,
            "produtos_id" => 14,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 28,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 31,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 22,
            "produtos_id" => 32,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 34,
            "filiais_id" => 2
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 10,
            "produtos_id" => 23,
            "filiais_id" => 2
        ]);

        //Seed Socio Jan
        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 1,
            "filiais_id" => 3
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 20,
            "produtos_id" => 2,
            "filiais_id" => 3
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 0,
            "produtos_id" => 3,
            "filiais_id" => 3
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 4,
            "filiais_id" => 3
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 1,
            "produtos_id" => 5,
            "filiais_id" => 3
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 14,
            "filiais_id" => 3
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 28,
            "filiais_id" => 3
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 31,
            "filiais_id" => 3
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 22,
            "produtos_id" => 32,
            "filiais_id" => 3
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 34,
            "filiais_id" => 3
        ]);

        //Seed Socio Tarcisio - CD Show
        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 1,
            "filiais_id" => 4
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 20,
            "produtos_id" => 2,
            "filiais_id" => 4
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 0,
            "produtos_id" => 3,
            "filiais_id" => 4
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 4,
            "filiais_id" => 4
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 1,
            "produtos_id" => 5,
            "filiais_id" => 4
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 14,
            "filiais_id" => 4
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 28,
            "filiais_id" => 4
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 31,
            "filiais_id" => 4
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 22,
            "produtos_id" => 32,
            "filiais_id" => 4
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 34,
            "filiais_id" => 4
        ]);

        //Seed Socio Branco
        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 1,
            "filiais_id" => 5
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 20,
            "produtos_id" => 2,
            "filiais_id" => 5
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 0,
            "produtos_id" => 3,
            "filiais_id" => 5
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 4,
            "filiais_id" => 5
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 1,
            "produtos_id" => 5,
            "filiais_id" => 5
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 14,
            "filiais_id" => 5
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 28,
            "filiais_id" => 5
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 31,
            "filiais_id" => 5
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 22,
            "produtos_id" => 32,
            "filiais_id" => 5
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 34,
            "filiais_id" => 5
        ]);

        //Seed Socio Taynara
        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 1,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 20,
            "produtos_id" => 2,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 0,
            "produtos_id" => 3,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 4,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 1,
            "produtos_id" => 5,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 10,
            "produtos_id" => 7,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 14,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 28,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 31,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 22,
            "produtos_id" => 32,
            "filiais_id" => 6
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 34,
            "filiais_id" => 6
        ]);


        //Seed Socio Rafa
        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 1,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 20,
            "produtos_id" => 2,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 22,
            "produtos_id" => 3,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 5,
            "produtos_id" => 4,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 1,
            "produtos_id" => 5,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 10,
            "produtos_id" => 7,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 14,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 6,
            "produtos_id" => 28,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 48,
            "produtos_id" => 31,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 0,
            "produtos_id" => 32,
            "filiais_id" => 7
        ]);

        DB::table('tb_estoque')->insert([
            "quantidade" => 0,
            "produtos_id" => 34,
            "filiais_id" => 7
        ]);
    }
}
