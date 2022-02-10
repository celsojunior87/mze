<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_clientes')->insert([
            'nome' => 'Consumidor Final',
            'email' => 'developer@mercadinhodoze.com.br',
            'cpf' => '11111111111',
            'telefone' => '61999999999',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tb_clientes')->insert([
            'nome' => 'Igor Barcelos',
            'email' => 'iigorbarcelos@gmail.com',
            'cpf' => '03265553159',
            'telefone' => '61992720108',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tb_clientes')->insert([
            'nome' => 'Jan Junior',
            'email' => 'janjr@jottasystem.com.br',
            'cpf' => '03150448107',
            'telefone' => '62981145958',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tb_clientes')->insert([
            'nome' => 'Tarcísio Coelho',
            'email' => 'tarciisiocoelho@gmail.com',
            'cpf' => '02199095126',
            'telefone' => '62992064510',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tb_clientes')->insert([
            'nome' => 'Branco',
            'email' => 'branco@mercadinhodoze.com.br',
            'cpf' => '99999999999',
            'telefone' => '61999999999',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tb_clientes')->insert([
            'nome' => 'Taynara Fonseca',
            'email' => 'taynara@mercadinhodoze.com.br',
            'cpf' => '22222222222',
            'telefone' => '61111111111',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tb_clientes')->insert([
            'nome' => 'Rafael Wilker',
            'email' => 'rafael@mercadinhodoze.com.br',
            'cpf' => '22222222222',
            'telefone' => '61111111111',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
