<?php

namespace App\Models;

use Database\Seeders\VendaTipoPagamentoSeeder;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venda extends Model
{
    protected $appends = ['checkado'];
    use HasFactory;


    public  $table = 'tb_vendas';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];



    public function cliente()
    {

        return $this->belongsTo(Cliente::class, 'clientes_id', 'id');
    }

    public function filas()
    {

        return $this->hasMany(FilaVendaFilial::class, 'filiais_id', 'id');
    }

    public function cupomDesconto()
    {

        return $this->belongsTo(CupomDesconto::class, 'cupom_descontos_id', 'id');
    }


    public function endereco()
    {

        return $this->belongsTo(Endereco::class, 'enderecos_id', 'id');
    }

    public function vendaItem()
    {

        return $this->hasMany(VendaItem::class, 'vendas_id');
    }

    public function vendaStatus()
    {
        return $this->belongsToMany(Status::class, 'tb_vendas_status', 'vendas_id', 'status_id')->withPivot('dt_atualizacao');
    }

    public function vendaTipoPagamento()
    {

        return $this->hasMany(VendaTipoPagamento::class, 'id',);
    }

    public function tipoCobranca()
    {

        return $this->hasMany(TipoCobranca::class, 'id');
    }

    public function produto()
    {
        return $this->belongsToMany(Produto::class, 'tb_vendas_itens', 'vendas_id', 'produtos_id');
    }

    public function status()
    {
        return $this->belongsToMany(Status::class, 'tb_status', 'id');
    }


    public function getcheckadoAttribute()
    {
    }


    public function getResumeAllPedidos()
    {
        $result = DB::table('tb_vendas as venda')
            ->select(
                'venda.id',
                'produtos.titulo',
                'produtos.descricao_detalhada',
                'produtos.ean',
                'produtos.unidade',
                'departamento.descricao as departamento',
                'produtos.url_imagem'
            )
            ->paginate(10);

        return $result;
    }


    public function getVendaById($id)
    {

        $result = DB::table('tb_vendas as vendas')
            ->join('tb_status as status', 'vendas.status_id', '=', 'status.id')
            ->join('tb_enderecos as enderecos', 'vendas.enderecos_id', '=', 'enderecos.id')
            ->leftJoin('tb_vendas_status as venda_status', function ($join) {
                $join->on('vendas.id', '=', 'venda_status.vendas_id');
            })
            ->whereIn('venda_status.status_id', [2, 7])
            ->select(
                'status.descricao as status',
                'venda_status.dt_atualizacao as horaaceito',
                'enderecos.endereco as endereco_entrega',
            )->where('vendas.id', $id)
            ->first();

        return $result;
    }


    public function getQuantidadePedidosFinalizados($idFilial)
    {
        $result = DB::table('tb_vendas as vendas')
            ->join('tb_vendas_itens as vendaItens', 'vendaItens.vendas_id', '=', 'vendas.id')
            ->join('tb_status as status', 'vendas.status_id', '=', 'status.id')
            ->whereIN('vendaItens.filiais_id', $idFilial)
            ->whereIn('vendas.status_id', [5, 12])
            ->distinct()->count('vendas.id');
        return $result;
    }

    public function getQuantidadePedidosAndamento($idFilial)
    {
        $result = DB::table('tb_vendas as vendas')
            ->join('tb_vendas_itens as vendaItens', 'vendaItens.vendas_id', '=', 'vendas.id')
            ->join('tb_status as status', 'vendas.status_id', '=', 'status.id')
            ->whereIN('vendaItens.filiais_id', $idFilial)
            ->whereNotIn('vendas.status_id', [5, 12, 6, 13])
            ->distinct('vendaItens.vendas_id')->count('vendas.id');
        return $result;
    }


    public function getPedidoAtual($idFilial)
    {
        $result = DB::table('tb_vendas as vendas')
            ->join('tb_vendas_itens as vendaItens', 'vendaItens.vendas_id', '=', 'vendas.id')
            ->join('tb_status as status', 'vendas.status_id', '=', 'status.id')
            ->whereIN('vendaItens.filiais_id', $idFilial)
            ->orderBy('vendas.id', 'DESC')
            ->first('vendas.id');
        return $result;
    }


    public function getFaturamento($idFilial, $greaterThan)
    {
        $dateTime = new \DateTime();
        $dateTime->setTimestamp(strtotime($greaterThan));

        // $result = DB::table('tb_vendas_itens')
        //     ->join('tb_vendas', 'tb_vendas_itens.vendas_id', '=', 'tb_vendas.id')
        //     ->join('tb_contas_receber', 'tb_contas_receber.vendas_id', '=', 'tb_vendas.id')
        //     ->distinct('vendas.id')->get();


        $result = DB::table('tb_vendas_itens')
            ->join('tb_vendas as vendas', 'tb_vendas_itens.vendas_id', '=', 'vendas.id')
            ->join('tb_contas_receber', 'tb_vendas_itens.vendas_id', '=', 'tb_contas_receber.vendas_id')
            ->whereIN('tb_vendas_itens.filiais_id', $idFilial)
            ->where('tb_contas_receber.dt_repasse', '>=', $dateTime)
            ->distinct('vendas.id')->get();
        $valorRepasse = 0;
        foreach ($result as $r) {
            $valorRepasse += $r->vl_repasse;
        }
        return $valorRepasse;
    }

    public function getValoresReceber($idFilial)
    {
        $data = new DateTime("Wednesday");
        $result = DB::table('tb_vendas_itens')
            ->join('tb_vendas as vendas', 'tb_vendas_itens.vendas_id', '=', 'vendas.id')
            ->join('tb_contas_receber as contasReceber', 'tb_vendas_itens.vendas_id', '=', 'contasReceber.id')
            ->whereIN('tb_vendas_itens.filiais_id', $idFilial)
            ->where('contasReceber.dt_repasse', $data)
            ->distinct('vendas.id')->get();
        $resultado = array();
        foreach ($result as $r) {
            $dados['vl_repasse'] = (float)number_format($r->vl_repasse, 2, '.', '');
            $dt_repasse = strtotime($r->dt_repasse);
            $dt_repasse = date('d/m/Y', $dt_repasse);
            $dados['dt_repasse'] = $dt_repasse;
            $resultado[] = $dados;
        }

        if (empty($resultado)) {
            $dados['vl_repasse'] = (float)0.00;
            $data = $data->format('d/m/Y');
            $dados['dt_repasse'] = $data;
        }
        return $dados;
    }
}
