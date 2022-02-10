<?php

namespace App\Repositories\Cliente;

use App\Interfaces\Cliente\PrecoClienteInterface;
use App\Models\Filial;
use App\Models\Mix;
use App\Models\Preco;
use App\Models\Regiao;
use App\Traits\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\BaseUrlReturn;

class PrecoClienteRepository implements PrecoClienteInterface
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
            return $this->error($e->getMessage(), 403);
        }
    }


    public function search($request)
    {
        if (!$request->regioes_id) return $this->error("A regiao id é obrigatória", 404);
        try {
            if ($request->departamentos_id) {

                $dados = $this->consultProductByDepartament($request);
                return $this->success("Detalhes dos Produtos", $dados);
            }
            $dados = $this->consultProduct($request);
            return $this->success("Detalhes dos Produtos", $dados);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 403);
        }
    }

    public function consultProduct($request)
    {
        $produto = $this->consultaProduto($request->regioes_id);

        $dados = [];
        foreach ($produto as $key => $prod) {
            $dados[$key]['id'] = $prod->id;
            $dados[$key]['titulo'] = $prod->titulo;
            $dados[$key]['descricao'] = $prod->descricao;
            $dados[$key]['qt_caixa'] = $prod->qt_caixa;
            $dados[$key]['descricao_detalhada'] = $prod->descricao_detalhada;
            $dados[$key]['ean'] = $prod->ean;
            $dados[$key]['unidade'] = $prod->unidade;
            $dados[$key]['url_imagem'] = $this->getUrl($prod->url_imagem);
            $dados[$key]['regioes_id'] = $prod->regioes_id;
            $dados[$key]['preco'] = floatval($prod->preco);
        }

        return $dados;
    }

    public function consultProductByDepartament($request)
    {
        $departamentos = DB::table('tb_departamentos')->where('id', '=', $request->departamentos_id)->get();

        foreach ($departamentos as $key => $dep) {

            $dados[$key]['id'] = $dep->id;
            $dados[$key]['descricao'] = $dep->descricao;
            $dados[$key]['url'] = $this->getUrl($dep->url);

            $secoes = $this->consultaSecao($request->regioes_id, $request->departamentos_id);
            foreach ($secoes as $key2 => $sec) {
                $dados[$key]['secoes'][$key2]['id'] = $sec->id;
                $dados[$key]['secoes'][$key2]['descricao'] = $sec->descricao;
                $dados[$key]['secoes'][$key2]['url'] = $this->getUrl($sec->url);

                $produto = $this->consultaProdutoPorSecao($request->regioes_id, $sec->id);
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
        return $dados;
    }


    public function consultaSecao($regioes_id, $departamentos_id)
    {
        $sql = "select tb_secoes.* from (
                select
                distinct tb_produtos.secoes_id as secoes_id
                from tb_mix_itens, tb_produtos
                where tb_mix_itens.produtos_id = tb_produtos.id
                and tb_mix_itens.mix_id in (select
                                            case when dados.mix_regiao = 0 then mix_regiao_padrao else mix_regiao
                                            end mix
                                            from
                                            (select
                                            tb_regioes.id,
                                            tb_estados.regiao_padrao_id,
                                            coalesce ((select id from tb_mix where regioes_id = tb_regioes.id),0) as mix_regiao,
                                            tb_mix.id as mix_regiao_padrao
                                            from tb_regioes, tb_estados, tb_mix
                                            where tb_regioes.estados_id = tb_estados.id
                                            and tb_mix.regioes_id = tb_estados.regiao_padrao_id
                                            and tb_regioes.id = $regioes_id) dados)) secoes,
                tb_secoes,
                tb_departamentos
                where tb_secoes.id = secoes.secoes_id
                and tb_departamentos.id = tb_secoes.departamentos_id
                and tb_secoes.departamentos_id = $departamentos_id
                and tb_secoes.situacao = true
                order by tb_secoes.descricao
            ";

        $secoes = DB::select($sql);

        return $secoes;
    }

    public function consultaProdutoPorSecao($regioes_id, $secoes_id)
    {
        $sql = "select
            tb_produtos.id,
            tb_produtos.titulo,
            tb_produtos.descricao,
            tb_produtos.qt_caixa,
            tb_produtos.descricao_detalhada,
            tb_produtos.ean,
            tb_produtos.unidade,
            tb_produtos.url_imagem,
            tb_precos.regioes_id,
            tb_precos.preco
            from tb_mix_itens, tb_produtos, tb_precos
            where tb_mix_itens.produtos_id = tb_produtos.id
            and tb_produtos.id = tb_precos.produtos_id
            and tb_precos.regioes_id = $regioes_id
            and tb_produtos.secoes_id = $secoes_id
            and tb_mix_itens.mix_id in (select
                                        case when dados.mix_regiao = 0 then mix_regiao_padrao else mix_regiao
                                        end mix
                                        from
                                        (select
                                        tb_regioes.id,
                                        tb_estados.regiao_padrao_id,
                                        coalesce ((select id from tb_mix where regioes_id = tb_regioes.id),0) as mix_regiao,
                                        tb_mix.id as mix_regiao_padrao
                                        from tb_regioes, tb_estados, tb_mix
                                        where tb_regioes.estados_id = tb_estados.id
                                        and tb_mix.regioes_id = tb_estados.regiao_padrao_id
                                        and tb_regioes.id = $regioes_id) dados)
            order by 2
        ";
        $produtos = DB::select($sql);

        return $produtos;
    }

    public function consultaProduto($regioes_id)
    {
        $sql = "select
            tb_produtos.id,
            tb_produtos.titulo,
            tb_produtos.descricao,
            tb_produtos.qt_caixa,
            tb_produtos.descricao_detalhada,
            tb_produtos.ean,
            tb_produtos.unidade,
            tb_produtos.url_imagem,
            tb_precos.regioes_id,
            tb_precos.preco
            from tb_mix_itens, tb_produtos, tb_precos
            where tb_mix_itens.produtos_id = tb_produtos.id
            and tb_produtos.id = tb_precos.produtos_id
            and tb_precos.regioes_id = $regioes_id
            and tb_mix_itens.mix_id in (select
                                        case when dados.mix_regiao = 0 then mix_regiao_padrao else mix_regiao
                                        end mix
                                        from
                                        (select
                                        tb_regioes.id,
                                        tb_estados.regiao_padrao_id,
                                        coalesce ((select id from tb_mix where regioes_id = tb_regioes.id),0) as mix_regiao,
                                        tb_mix.id as mix_regiao_padrao
                                        from tb_regioes, tb_estados, tb_mix
                                        where tb_regioes.estados_id = tb_estados.id
                                        and tb_mix.regioes_id = tb_estados.regiao_padrao_id
                                        and tb_regioes.id = $regioes_id) dados)
            order by 2
        ";
        $produtos = DB::select($sql);

        return $produtos;
    }
}
