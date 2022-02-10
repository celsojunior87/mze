<?php

namespace App\Repositories\SelfCheckout;

use App\Interfaces\SelfCheckout\PrecoAutoAtendimentoInterface;
use App\Models\Departamento;
use App\Models\Filial;
use App\Models\Mix;
use App\Models\Preco;
use App\Models\Regiao;
use App\Traits\Response;
use App\Traits\BaseUrlReturn;
use Illuminate\Support\Facades\DB;

class PrecoAutoAtendimentoRepository implements PrecoAutoAtendimentoInterface
{
    public function __construct(Preco $preco)
    {
        $this->preco = $preco;
    }

    use Response, BaseUrlReturn;

    public function getAll()
    {
        try {
            $preco = Preco::all();
            return $this->success("Lista de preco", $preco);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function findById($id)
    {
        try {
            $preco = Preco::find($id);
            //$departamento = Departamento::find($produto->departamentos_id);
            //$produto->departamento = $departamento->descricao;
            if (!$preco) return $this->error("Não Possui preco $id", 404);
            return $this->success("Detalhes dos Produtos", $preco);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }


    public function search($request)
    {
        if (!$request->regioes_id) return $this->error("A regiao id é obrigatória", 404);
        try {

            if ($request->departamentos_id) {
                $dados = $this->consultProductByDepartament($request);
                if (!$dados) {
                    return $this->error("Não existem produtos cadastrados nessa região.", 500);
                }
                return $this->success("Detalhes dos Produtos", $dados);
            }
            $dados = $this->consultProduct($request);
            if (!$dados) {
                return $this->error("Não existem produtos cadastrados nessa região.", 500);
            }

            return $this->success("Detalhes dos Produtos", $dados);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function consultProduct($request)
    {
        $departamentos = Departamento::all();

        foreach ($departamentos as $key => $dep) {
            $dados[$key]['id'] = $dep->id;
            $dados[$key]['descricao'] = $dep->descricao;
            $dados[$key]['url'] = $this->getUrl($dep->url);
            $produto = DB::table('tb_produtos')
                ->where('tb_precos.regioes_id', '=', $request->regioes_id)
                ->where('departamentos_id', '=', $dep->id)
                ->join('tb_precos', 'produtos_id', '=', 'tb_produtos.id')
                ->select(
                    'tb_produtos.id',
                    'tb_produtos.titulo',
                    'tb_produtos.descricao',
                    'tb_produtos.qt_caixa',
                    'tb_produtos.descricao_detalhada',
                    'tb_produtos.ean',
                    'tb_produtos.unidade',
                    'tb_produtos.url_imagem',
                    'tb_precos.regioes_id',
                    'tb_precos.preco',
                )
                ->orderBy('tb_produtos.titulo')
                ->get();
            foreach ($produto as $key2 => $prod) {
                $dados[$key]['produtos'][$key2]['id'] = $prod->id;
                $dados[$key]['produtos'][$key2]['titulo'] = $prod->titulo;
                $dados[$key]['produtos'][$key2]['descricao'] = $prod->descricao;
                $dados[$key]['produtos'][$key2]['qt_caixa'] = $prod->qt_caixa;
                $dados[$key]['produtos'][$key2]['descricao_detalhada'] = $prod->descricao_detalhada;
                $dados[$key]['produtos'][$key2]['ean'] = $prod->ean;
                $dados[$key]['produtos'][$key2]['unidade'] = $prod->unidade;
                $dados[$key]['produtos'][$key2]['url_imagem'] = $this->getUrl($prod->url_imagem);
                $dados[$key]['produtos'][$key2]['regioes_id'] = $prod->regioes_id;
                $dados[$key]['produtos'][$key2]['preco'] = floatval($prod->preco);
            }
        }
        if (empty($dados)) {
            return false;
        }

        return $dados;
    }

    public function consultProductByDepartament($request)
    {
        $departamentos = DB::table('tb_departamentos')->where('id', '=', $request->departamentos_id)->get();
        foreach ($departamentos as $key => $dep) {

            $dados[$key]['id'] = $dep->id;
            $dados[$key]['descricao'] = $dep->descricao;
            $dados[$key]['url'] = $dep->url;

            $secoes = DB::table('tb_secoes')->where('departamentos_id', '=', $dep->id)->orderBy('tb_secoes.descricao')->get();
            foreach ($secoes as $key2 => $sec) {
                $dados[$key]['secoes'][$key2]['id'] = $sec->id;
                $dados[$key]['secoes'][$key2]['descricao'] = $sec->descricao;
                $dados[$key]['secoes'][$key2]['url'] = $this->getUrl($sec->url);
                $produto = DB::table('tb_produtos')
                    ->where('tb_precos.regioes_id', '=', $request->regioes_id)
                    ->where('secoes_id', '=', $sec->id)
                    ->join('tb_precos', 'produtos_id', '=', 'tb_produtos.id')
                    ->select(
                        'tb_produtos.id',
                        'tb_produtos.titulo',
                        'tb_produtos.descricao',
                        'tb_produtos.qt_caixa',
                        'tb_produtos.descricao_detalhada',
                        'tb_produtos.ean',
                        'tb_produtos.unidade',
                        'tb_produtos.url_imagem',
                        'tb_precos.regioes_id',
                        'tb_precos.preco',
                    )
                    ->orderBy('tb_produtos.titulo')
                    ->get();
                foreach ($produto as $key3 => $prod) {
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['id'] = $prod->id;
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['titulo'] = $prod->titulo;
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['descricao'] = $prod->descricao;
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['qt_caixa'] = $prod->qt_caixa;
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['descricao_detalhada'] = $prod->descricao_detalhada;
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['ean'] = $prod->ean;
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['unidade'] = $prod->unidade;
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['url_imagem'] = $this->getUrl($prod->url_imagem);
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['regioes_id'] = $prod->regioes_id;
                    $dados[$key]['secoes'][$key2]['produtos'][$key3]['preco'] = floatval($prod->preco);
                }
            }
        }

        if (empty($dados)) {
            return false;
        }

        return $dados;
    }
}
