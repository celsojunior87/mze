<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_socios')->insert([
            'nome' => 'Usuario Padrão Dev',
            'email' => 'developer@mercadinhodoze.com.br',
            'cpf' => '00700700757',
            'telefone' => '61999999999',
            'avaliacao_media' => 4.5,
            'raio_entrega' => 5,
            'url_foto' => 'foto',
            'url_documento_frente' => 'foto_frente',
            'url_documento_verso' => 'foto_verso',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'enderecos_id' => 1
        ]);

        DB::table('tb_socios')->insert([
            'nome' => 'Igor Barcelos',
            'email' => 'iigorbarcelos@gmail.com',
            'cpf' => '03265553159',
            'telefone' => '61992720108',
            'avaliacao_media' => 4.7,
            'raio_entrega' => 3.5,
            'url_foto' => 'foto',
            'url_documento_frente' => 'foto_frente',
            'url_documento_verso' => 'foto_verso',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'enderecos_id' => 2
        ]);

        DB::table('tb_socios')->insert([
            'nome' => 'Jan Junior',
            'email' => 'janjr@jottasystem.com.br',
            'cpf' => '03150448107',
            'telefone' => '62981145958',
            'avaliacao_media' => 5.0,
            'raio_entrega' => 4,
            'url_foto' => 'foto',
            'url_documento_frente' => 'foto_frente',
            'url_documento_verso' => 'foto_verso',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'enderecos_id' => 3
        ]);

        DB::table('tb_socios')->insert([
            'nome' => 'Tarcísio Coelho',
            'email' => 'tarciisiocoelho@gmail.com',
            'cpf' => '02199095126',
            'telefone' => '62992064510',
            'avaliacao_media' => 2.0,
            'raio_entrega' => 4.8,
            'url_foto' => 'foto',
            'url_documento_frente' => 'foto_frente',
            'url_documento_verso' => 'foto_verso',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'enderecos_id' => 4
        ]);

        DB::table('tb_socios')->insert([
            'nome' => 'Branco',
            'email' => 'branco@mercadinhodoze.com.br',
            'cpf' => '99999999999',
            'telefone' => '61999999999',
            'avaliacao_media' => 2.5,
            'raio_entrega' => 5,
            'url_foto' => 'foto',
            'url_documento_frente' => 'foto_frente',
            'url_documento_verso' => 'foto_verso',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'enderecos_id' => 5
        ]);

        DB::table('tb_socios')->insert([
            'nome' => 'Taynara Fonseca',
            'email' => 'taynara@mercadinhodoze.com.br',
            'cpf' => '11111111111',
            'telefone' => '61111111111',
            'avaliacao_media' => 5.0,
            'raio_entrega' => 3,
            'url_foto' => 'foto',
            'url_documento_frente' => 'foto_frente',
            'url_documento_verso' => 'foto_verso',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'enderecos_id' => 6
        ]);

        DB::table('tb_socios')->insert([
            'nome' => 'Rafael Wilker',
            'email' => 'rafael@mercadinhodoze.com.br',
            'cpf' => '22222222222',
            'telefone' => '61111111111',
            'avaliacao_media' => 2.8,
            'raio_entrega' => 2.8,
            'url_foto' => 'foto',
            'url_documento_frente' => 'foto_frente',
            'url_documento_verso' => 'foto_verso',
            'password' => bcrypt('mze'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'enderecos_id' => 7
        ]);
    }
}
