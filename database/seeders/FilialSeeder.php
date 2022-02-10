<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FilialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_filiais')->insert([
            'descricao' => 'Mercadinho do Dev',
            'cnpj' => '00700700757',
            'socios_id' => 1,
            'tipo_filial' => 1,
            'url_imagem' => "foto",
            'token_filial' => md5('00700700757' . 'SGCV Sul, Sgcv Lt 12/22 Ae'),
            'filial_aberta' => true,
            'enderecos_id' => 1
        ]);

        DB::table('tb_filiais')->insert([
            'descricao' => 'Mercadinho do Igor',
            'cnpj' => '03265553159',
            'socios_id' => 2,
            'tipo_filial' => 1,
            'url_imagem' => "foto",
            'token_filial' => md5('03265553159' . 'Av. das Araucárias, 4155'),
            'filial_aberta' => true,
            'enderecos_id' => 2
        ]);

        DB::table('tb_filiais')->insert([
            'descricao' => 'Mercadinho do Jan',
            'cnpj' => '03150448107',
            'socios_id' => 3,
            'tipo_filial' => 1,
            'url_imagem' => "foto",
            'token_filial' => md5('03150448107' . 'SH Grande Colorado Condomínio Vivendas Friburgo'),
            'filial_aberta' => true,
            'enderecos_id' => 3
        ]);

        DB::table('tb_filiais')->insert([
            'descricao' => 'Mercadinho do Tarcísio',
            'cnpj' => '02199095126',
            'socios_id' => 4,
            'tipo_filial' => 1,
            'url_imagem' => "foto",
            'token_filial' => md5('02199095126' . 'Av. das Araucárias, 1835/2005'),
            'filial_aberta' => true,
            'enderecos_id' => 4
        ]);

        DB::table('tb_filiais')->insert([
            'descricao' => 'Mercadinho do Branco',
            'cnpj' => '99999999999',
            'socios_id' => 5,
            'tipo_filial' => 1,
            'url_imagem' => "foto",
            'token_filial' => md5('99999999999' . 'SIA Trecho 6 Lote 85 ao 95 Zona Industrial'),
            'filial_aberta' => true,
            'enderecos_id' => 5
        ]);

        DB::table('tb_filiais')->insert([
            'descricao' => 'Mercadinho do Taynara',
            'cnpj' => '11111111111',
            'socios_id' => 6,
            'tipo_filial' => 1,
            'url_imagem' => "foto",
            'token_filial' => md5('11111111111' . 'EQRSW 1/2, Lote 1 S/N'),
            'filial_aberta' => true,
            'enderecos_id' => 6
        ]);

        DB::table('tb_filiais')->insert([
            'descricao' => 'Mercadinho do Rafael',
            'cnpj' => '22222222222',
            'socios_id' => 7,
            'tipo_filial' => 1,
            'url_imagem' => "foto",
            'token_filial' => md5('22222222222' . 'Guará II QE 25 Feira do Guara'),
            'filial_aberta' => true,
            'enderecos_id' => 7
        ]);
    }
}
