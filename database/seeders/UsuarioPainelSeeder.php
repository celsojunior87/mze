<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioPainelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_administradores')->insert([
            'nome' => 'Super Admin',
            'email' => 'admin@mercadinhodoze.com.br',
            'cpf' => '00000000000',
            'password' => bcrypt('123$qweR'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
    }
}
