<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Enderecos Socios
        DB::table('tb_enderecos')->insert([
            'descricao' => 'The Brain',
            'cep' => '70803000',
            'endereco' => 'SGCV Sul, Lt 12/22 Ae Shopping Casa Park,',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "park sul",
            'cidade' => 'Brasilia',
            'complemento' => '1º Andar',
            'tipo' => "CASA",
            'latitude' => "-15.82621571669673",
            'longitude' => "-47.95290815397216",
            "regioes_id" => 28
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'DIA A DIA',
            'cep' => '71205-060',
            'endereco' => 'SIA Trecho 6 Lote 85 ao 95',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "Guará",
            'cidade' => 'Brasília',
            'complemento' => 'Zona Industrial',
            'tipo' => "CASA",
            'latitude' => "-15.799507166055776",
            'longitude' => "-47.94908457691947",
            "regioes_id" => 28
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'CASA',
            'cep' => '71000-000',
            'endereco' => 'Conjunto K - 18',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "Grande Colorado",
            'cidade' => 'Brasilia',
            'complemento' => 'Condomínio Vivendas Friburgo',
            'tipo' => "CASA",
            'latitude' => "-15.675166380978023",
            'longitude' => "-47.8443853863007",
            "regioes_id" => 7
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'CASA',
            'cep' => '71936-250',
            'endereco' => 'Av. das Araucárias',
            'numero' => '1835/2005',
            'uf' => "DF",
            'bairro' => "Águas Claras",
            'cidade' => 'Brasília',
            'complemento' => 'Aguas Claras Shopping',
            'tipo' => "CASA",
            'latitude' => "-15.834404252574226",
            'longitude' => "-48.04311357532242",
            "regioes_id" => 29
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'DIA A DIA',
            'cep' => '71205-060',
            'endereco' => 'SIA Trecho 6 Lote 85 ao 95',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "Guará",
            'cidade' => 'Brasília',
            'complemento' => 'Zona Industrial',
            'tipo' => "CASA",
            'latitude' => "-15.799507166055776",
            'longitude' => "-47.94908457691947",
            "regioes_id" => 28
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'CASA',
            'cep' => '70675-160',
            'endereco' => 'EQRSW 1/2',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "Sudoeste",
            'cidade' => 'Brasilia',
            'complemento' => 'Lote 1',
            'tipo' => "CASA",
            'latitude' => "-15.793805131671164",
            'longitude' => "-47.93271057166022",
            "regioes_id" => 7
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'CASA',
            'cep' => '70297-400',
            'endereco' => 'Guará II QE 25',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "Guará",
            'cidade' => 'Brasilia',
            'complemento' => 'Feira do Guara',
            'tipo' => "CASA",
            'latitude' => "-15.824001788243063",
            'longitude' => "-47.97580359957303",
            "regioes_id" => 28
        ]);



        //Endereço Cliente
        DB::table('tb_enderecos')->insert([
            'descricao' => 'The Brain',
            'cep' => '70803000',
            'endereco' => 'SGCV Sul, Lt 12/22 Ae Shopping Casa Park,',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "park sul",
            'cidade' => 'Brasilia',
            'complemento' => '1º Andar',
            'tipo' => "CASA",
            'latitude' => "-15.82621571669673",
            'longitude' => "-47.95290815397216",
            "regioes_id" => 28
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'CASA',
            'cep' => '71936-250',
            'endereco' => 'Av. das Araucárias',
            'numero' => '4155',
            'uf' => "DF",
            'bairro' => "Águas Claras Sul",
            'cidade' => 'Brasilia',
            'complemento' => 'apartamento 1001 C',
            'tipo' => "CASA",
            'latitude' => "-15.834404252574226",
            'longitude' => "-48.04311357532242",
            "regioes_id" => 29
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'CASA',
            'cep' => '71000-000',
            'endereco' => 'Conjunto K - 18',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "Grande Colorado",
            'cidade' => 'Brasilia',
            'complemento' => 'Condomínio Vivendas Friburgo',
            'tipo' => "CASA",
            'latitude' => "-15.675313673262023",
            'longitude' => "-47.84463411241831",
            "regioes_id" => 7
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'CASA',
            'cep' => '71936-250',
            'endereco' => 'Av. das Araucárias',
            'numero' => '1835/2005',
            'uf' => "DF",
            'bairro' => "Águas Claras",
            'cidade' => 'Brasília',
            'complemento' => 'Aguas Claras Shopping',
            'tipo' => "CASA",
            'latitude' => "-15.834404252574226",
            'longitude' => "-48.04311357532242",
            "regioes_id" => 29
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'DIA A DIA',
            'cep' => '71205-060',
            'endereco' => 'SIA Trecho 6 Lote 85 ao 95',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "Guará",
            'cidade' => 'Brasília',
            'complemento' => 'Zona Industrial',
            'tipo' => "CASA",
            'latitude' => "-15.799507166055776",
            'longitude' => "-47.94908457691947",
            "regioes_id" => 28
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'CASA',
            'cep' => '70675-160',
            'endereco' => 'EQRSW 1/2',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "Sudoeste",
            'cidade' => 'Brasilia',
            'complemento' => 'Lote 1',
            'tipo' => "CASA",
            'latitude' => "-15.793805131671164",
            'longitude' => "-47.93271057166022",
            "regioes_id" => 7
        ]);

        DB::table('tb_enderecos')->insert([
            'descricao' => 'CASA',
            'cep' => '70297-400',
            'endereco' => 'Guará II QE 25',
            'numero' => 'SN',
            'uf' => "DF",
            'bairro' => "Guará",
            'cidade' => 'Brasilia',
            'complemento' => 'Feira do Guara',
            'tipo' => "CASA",
            'latitude' => "-15.824001788243063",
            'longitude' => "-47.97580359957303",
            "regioes_id" => 28
        ]);
    }
}
