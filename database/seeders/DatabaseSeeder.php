<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EstadoSeeder::class,
            DepartamentoSeeder::class,
            SecaoSeeder::class,
            ProdutoSeeder::class,
            TipoCobrancasSeeder::class,
            UsuarioSeeder::class,
            RegiaoSeeder::class,
            EnderecoSeeder::class,
            PrecoSeeder::class,
            ParametroPresidencialSeeder::class,
            MixSeeder::class,
            MixItemSeeder::class,
            InstituicaoFinanceiraSeeder::class,
            SocioSeeder::class,
            FilialSeeder::class,
            StatusSeeder::class,
            PromocaoSeeder::class,
            UsuarioPainelSeeder::class,
            CobrancaClienteSeeder::class,
            EnderecoClienteSeeder::class,
            EstoqueSeeder::class,
            ChatClienteSocioSeeder::class,
            ContasReceberSeeder::class,
            VendaSeeder::class,
            VendaItemSeeder::class,
            VendaStatusSeeder::class
        ]);
    }
}
