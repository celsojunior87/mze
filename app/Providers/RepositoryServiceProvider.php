<?php

namespace App\Providers;

use App\Interfaces\ChatClienteSocioInterface;
use App\Interfaces\Cliente\NotificacaoClienteInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Interface and Repository in here
        // You must place Interface in first place
        // If you dont, the Repository will not get readed.
        $this->app->bind(

            'App\Interfaces\All\InstituicaoFinanceiraInterface',
            'App\Repositories\All\InstituicaoFinanceiraRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\DepartamentoClienteInterface',
            'App\Repositories\Cliente\DepartamentoClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\DepartamentoPainelInterface',
            'App\Repositories\Painel\DepartamentoPainelRepository'
        );

        $this->app->bind(
            'App\Interfaces\SelfCheckout\DepartamentoAutoAtendimentoInterface',
            'App\Repositories\Painel\DepartamentoAutoAtendimentoRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\ClienteInterface',
            'App\Repositories\Cliente\ClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\ProdutoClienteInterface',
            'App\Repositories\Cliente\ProdutoClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\ProdutoPainelInterface',
            'App\Repositories\Painel\ProdutoPainelRepository'
        );

        $this->app->bind(
            'App\Interfaces\SelfCheckout\ProdutoAutoAtendimentoInterface',
            'App\Repositories\Painel\ProdutoAutoAtendimentolRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\CobrancaClienteInterface',
            'App\Repositories\Cliente\CobrancaClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\EnderecoClienteInterface',
            'App\Repositories\Cliente\EnderecoClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\SecaoPainelInterface',
            'App\Repositories\Painel\SecaoPainelRepository'
        );


        $this->app->bind(
            'App\Interfaces\RegiaoInterface',
            'App\Repositories\RegiaoRepository'
        );


        $this->app->bind(
            'App\Interfaces\Cliente\PromocaoClienteInterface',
            'App\Repositories\Cliente\PromocaoClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\PromocaoPainelInterface',
            'App\Repositories\Painel\PromocaoPainelRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\MixPainelInterface',
            'App\Repositories\Painel\MixPainelRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\MixClienteInterface',
            'App\Repositories\Cliente\MixClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\VendaClienteInterface',
            'App\Repositories\Cliente\VendaClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Socio\VendaSocioInterface',
            'App\Repositories\Socio\VendaSocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\VendaPainelInterface',
            'App\Repositories\Painel\VendaPainelRepository'
        );


        $this->app->bind(
            'App\Interfaces\SelfCheckout\VendaAutoAtendimentoInterface',
            'App\Repositories\SelfCheckout\VendaAutoAtendimentoRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\MixItemClienteInterface',
            'App\Repositories\Cliente\MixItemClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\MixItemPainelInterface',
            'App\Repositories\Painel\MixItemPainelRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\TipoPagamentoClienteInterface',
            'App\Repositories\Cliente\TipoPagamentoClienteRepository'
        );
        $this->app->bind(
            'App\Interfaces\Painel\TipoPagamentoPainelInterface',
            'App\Repositories\Painel\TipoPagamentoPainelRepository'
        );


        $this->app->bind(
            'App\Interfaces\Socio\SocioInterface',
            'App\Repositories\Socio\SocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\All\FilialInterface',
            'App\Repositories\All\FilialRepository'
        );

        $this->app->bind(
            'App\Interfaces\All\ContaBancariaInterface',
            'App\Repositories\All\ContaBancariaRepository'
        );

        $this->app->bind(
            'App\Interfaces\Socio\FilialInterface',
            'App\Repositories\Socio\FilialSocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\PrecoClienteInterface',
            'App\Repositories\Cliente\PrecoClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\PrecoPainelInterface',
            'App\Repositories\Painel\PrecoPainelRepository'
        );


        $this->app->bind(
            'App\Interfaces\SelfCheckout\PrecoAutoAtendimentoInterface',
            'App\Repositories\SelfCheckout\PrecoAutoAtendimentoRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\PainelCupomDescontoInterface',
            'App\Repositories\Painel\PainelCupomDescontoRepository'
        );

        $this->app->bind(
            'App\Interfaces\NotificacaoClienteInterface',
            'App\Repositories\NotificacaoClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\ChatClienteSocioInterface',
            'App\Repositories\ChatClienteSocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\Socio\EstoqueSocioInterface',
            'App\Repositories\Socio\EstoqueSocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\EstoquePainelInterface',
            'App\Repositories\Painel\EstoquePainelRepository'
        );

        $this->app->bind(
            'App\Interfaces\Socio\VendaTrocaSocioInterface',
            'App\Repositories\Socio\VendaTrocaSocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\Socio\VendaStatusSocioInterface',
            'App\Repositories\Socio\VendaStatusSocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\NotificacaoClienteInterface',
            'App\Repositories\Cliente\NotificacaoClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Socio\NotificacaoSocioInterface',
            'App\Repositories\Socio\NotificacaoSocioRepository'
        );
        $this->app->bind(
            'App\Interfaces\Painel\NotificacaoPainelInterface',
            'App\Repositories\Painel\NotificacaoPainelRepository'
        );


        $this->app->bind(
            'App\Interfaces\Socio\HomeSocioInterface',
            'App\Repositories\Socio\HomeSocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\Socio\DashboardSocioInterface',
            'App\Repositories\Socio\DashboardSocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\SocioPainelInterface',
            'App\Repositories\Painel\SocioPainelRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\StatusPainelInterface',
            'App\Repositories\Painel\StatusPainelRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\TipoCobrancaPainelInterface',
            'App\Repositories\Painel\TipoCobrancaPainelRepository'
        );

        $this->app->bind(
            'App\Interfaces\Socio\StatusSocioInterface',
            'App\Repositories\Socio\StatusSocioRepository'
        );

        $this->app->bind(
            'App\Interfaces\Cliente\StatusClienteInterface',
            'App\Repositories\Cliente\StatusClienteRepository'
        );

        $this->app->bind(
            'App\Interfaces\Painel\ClientePainelInterface',
            'App\Repositories\Painel\ClientePainelRepository'
        );
    }
}
