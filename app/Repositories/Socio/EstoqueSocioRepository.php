<?php

namespace App\Repositories\Socio;

use App\Http\Requests\EstoqueSocioRequest;
use App\Interfaces\Socio\EstoqueSocioInterface;
use App\Models\Auditoria;
use App\Models\AuditoriaItem;
use App\Models\EntradaMercadoria;
use App\Models\EntradaMercadoriaItem;
use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EstoqueSocioRepository implements EstoqueSocioInterface
{
    use Response;

    public function storeAll(EstoqueSocioRequest $request)
    {


        $login = $this->loginApiDiaDIa();

        if (!$login) {
            return $this->error("Erro ao efetuar o login.", 401);
        }

        $dadosDiaDia = $this->consumirDadosDiaDia($request, $login);

        if ($dadosDiaDia->sucesso == false) {
            return $this->error($dadosDiaDia->mensagem, 400);
        }

        $dadosDiaDia = $dadosDiaDia->dados[0];

        $ean = EntradaMercadoria::where(['qr_code' => $dadosDiaDia->chavenfce])->exists();
        if ($ean) {
            return $this->error("Cupom fiscal já cadastrado.", 201);
        }

        $user = Auth::user();

        if ($user) {
            DB::beginTransaction();
            try {
                $entradaMercadoria = $this->entradaMercadoria($dadosDiaDia);
                $entradaMercadoria->save();
                DB::commit();
                $entradaMercadoriaItem = $this->entradaMercadoriaItem($entradaMercadoria->id, $dadosDiaDia, $request->filial_id);
                if (!$entradaMercadoriaItem) {
                    return response()->json(['message' => 'Produto não encontrado'], 401);
                }
                return $this->success("Entrada de Mercadoria Criado com sucesso", $entradaMercadoria, 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->error($e->getMessage(), 401);
            }
        }
    }

    public function list(EstoqueSocioRequest $request)
    {
        $login = $this->loginApiDiaDIa();

        if (!$login) {
            return $this->error("Erro ao efetuar o login.", 401);
        }

        $dadosDiaDia = $this->consumirDadosDiaDia($request, $login);

        if ($dadosDiaDia->sucesso == false) {
            return $this->error($dadosDiaDia->mensagem, 400);
        }

        $dadosDiaDia = $dadosDiaDia->dados[0];

        $ean = EntradaMercadoria::where(['qr_code' => $dadosDiaDia->chavenfce])->exists();
        if ($ean) {
            // return $this->error("Cupom fiscal já cadastrado.", 400);
        }

        $itens = $dadosDiaDia->itens;
        foreach ($itens as $item) {
            $produto = Produto::where(['ean' => $item->codauxiliar])->get()->toArray();
            if (!array_key_exists('0', $produto)) {
                //return $this->error("Produto não encontrado no mix.", 400);;
            }
        }

        return $this->success("Lista de produtos.", $dadosDiaDia, 200);
    }

    public function search($request)
    {
        if (!empty($request->filial_id)) {
            $produtos = $this->consultaProdutosFilial($request);

            if (!$produtos) {
                return $this->error("Produto não encontrado.", 400);
            }

            return $this->success("Lista de produtos.", $produtos, 200);
        }

        if (!empty($request->ean)) {

            $produtos = $this->consultaEan($request);

            if (!$produtos) {
                return $this->error("Produto não encontrado.", 400);
            }

            return $this->success("Lista de produto.", $produtos, 200);
        }

        return $this->error("Envie o filial id ou ean.", 400);
    }

    public function auditoria($request)
    {
        try {
            DB::beginTransaction();
            $auditoria = new Auditoria();
            $auditoria->descricao = $request->descricao;
            $auditoria->tipo = $request->tipo;
            $auditoria->dt_criacao = Carbon::now();
            $auditoria->dt_finalizacao = Carbon::now();
            $auditoria->filiais_id = $request->filiais_id;
            $auditoria->save();
            DB::commit();
            $dados = $request->itens;
            foreach ($dados as $d) {
                $auditoriaItens = new AuditoriaItem();
                $auditoriaItens->qt_atual = $d['quantidade'];
                $auditoriaItens->qt_contagem = $d['quantidade_real'];
                $auditoriaItens->justificativa = $d['justificativa'];
                $auditoriaItens->dt_contagem = Carbon::now();
                $auditoriaItens->auditoria_id = $auditoria->id;
                $auditoriaItens->produtos_id = $d['id'];
                if ($auditoriaItens->qt_atual != $auditoriaItens->qt_contagem) {
                    $auditoriaItens->save();
                    DB::commit();
                }

                //Atualiza estoque
                $estoque = new Estoque();
                $estoque->quantidade = $auditoriaItens->qt_contagem;
                $estoque->produtos_id = $auditoriaItens->produtos_id;
                $estoque->filiais_id =  $auditoria->filiais_id;

                Estoque::updateOrCreate(
                    [
                        "produtos_id" => $estoque->produtos_id,
                        "filiais_id" => $estoque->filiais_id
                    ],
                    [
                        "produtos_id" => $estoque->produtos_id,
                        "filiais_id" => $estoque->filiais_id,
                        "quantidade" => $estoque->quantidade
                    ]

                );
                DB::commit();
            }
            return $this->success("Auditoria cadastrada com sucesso.", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error("Erro ao cadastrar auditoria.", 400);
        }
    }

    public function entradaMercadoria($request)
    {
        // dd($request);
        $entradaMercadoria = new EntradaMercadoria();
        $entradaMercadoria->dt_entrada = $request->data;
        $entradaMercadoria->qr_code = $request->chavenfce;
        $entradaMercadoria->vl_total = $request->vltotal;

        return $entradaMercadoria;
    }

    public function entradaMercadoriaItem($entradaMercadoriaId, $request, $idFilial)
    {
        $itens = $request->itens;
        foreach ($itens as $item) {

            $produto = Produto::where(['ean' => $item->codauxiliar])->get()->toArray();

            if (!array_key_exists('0', $produto)) {
                return false;
            }
            /*save entrada de mercadoria item */
            $produtoId = $produto[0]['id'];
            $entradaMercadoriaItem = new EntradaMercadoriaItem();
            $entradaMercadoriaItem->valor = $item->pvenda;
            $entradaMercadoriaItem->quantidade = $item->qt;
            $entradaMercadoriaItem->entrada_mercadorias_id = $entradaMercadoriaId;
            $entradaMercadoriaItem->produtos_id = $produtoId;
            $entradaMercadoriaItem->save();

            /*save estoque*/
            $estoque = new Estoque();
            $estoque->quantidade = $item->qt;
            $estoque->produtos_id = $produtoId;
            $estoque->filiais_id =  $idFilial;

            $prod = Estoque::where([
                ['produtos_id', $estoque->produtos_id],
                ["filiais_id", $estoque->filiais_id]
            ])->get()->toArray();

            $qtd_antiga = 0;
            if (array_key_exists('0', $prod)) {
                $qtd_antiga = $prod[0]['quantidade'];
            }
            Estoque::updateOrCreate(
                [
                    "produtos_id" => $estoque->produtos_id,
                    "filiais_id" => $estoque->filiais_id
                ],
                [
                    "produtos_id" => $estoque->produtos_id,
                    "filiais_id" => $estoque->filiais_id,
                    "quantidade" => $estoque->quantidade + $qtd_antiga
                ]

            );
            DB::commit();
        }

        return true;
    }

    public function loginApiDiaDIa()
    {

        $data = [
            "login" => "mze",
            "senha" => 'I12tlNw&#z$Si&a'
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mercadinhodoze.ddlabs.com.br/api/v1/autenticacao/login.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $dados = json_decode($response);
        if ($err) {
            return false;
        }

        if ($dados->sucesso != true) {
            return false;
        } else {
            return $dados->dados[0]->token;
        }
    }

    public function consumirDadosDiaDia($dados, $token)
    {
        $authorization = "Authorization: Bearer " . $token;

        if ($dados->chavenfce) {
            $chavenfce = explode('|', $dados->chavenfce);
            $chavenfce = explode('=', $chavenfce[0]);
            $chavenfce = $chavenfce[1];
        }

        $data = [
            "chavenfce" => $chavenfce,
            "cpf" => $dados->cpf
        ];

        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mercadinhodoze.ddlabs.com.br/api/v1/mercadinhodoze/consultar.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                $authorization
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        $dados = json_decode($response);

        if ($err) {
            return false;
        }

        return $dados;
    }

    public function consultaProdutosFilial($dados)
    {
        $cont = 0;
        $produtos = DB::table('tb_estoque')
            ->where('filiais_id', $dados->filial_id)
            ->join('tb_produtos', 'tb_estoque.produtos_id', '=', 'tb_produtos.id')
            ->select(
                'tb_produtos.id',
                'tb_produtos.titulo',
                'tb_produtos.descricao',
                'tb_produtos.ean',
                'tb_produtos.url_imagem',
                'tb_estoque.quantidade',
                'tb_estoque.updated_at'
            )
            ->get();

        if (empty($produtos->toArray())) {
            return false;
        }

        foreach ($produtos as $prod) {
            $ret[$cont]['id'] = $prod->id;
            $ret[$cont]['titulo'] = $prod->titulo;
            $ret[$cont]['descricao'] = $prod->descricao;
            $ret[$cont]['ean'] = $prod->ean;
            $ret[$cont]['url_imagem'] = $prod->url_imagem;
            $ret[$cont]['quantidade'] = $prod->quantidade;
            $data = explode(' ', $prod->updated_at);
            $data = explode('-', $data[0]);
            $ret[$cont]['updated_at'] = $data[2] . '/' . $data[1] . '/' . $data[0];
            $ret[$cont]['quantidade_real'] = '';
            $ret[$cont]['justificativa'] = '';
            $cont++;
        }

        return $ret;
    }

    public function consultaEan($dados)
    {

        $produtos = Produto::where(['ean' => $dados->ean])->get()->toArray();
        if (empty($produtos[0])) {
            return false;
        }

        $estoque = Estoque::where(['produtos_id' => $produtos[0]['id']])->get()->toArray();
        if (empty($estoque[0])) {
            return false;
        }

        $ret['id'] = $produtos[0]['id'];
        $ret['titulo'] = $produtos[0]['titulo'];
        $ret['descricao'] = $produtos[0]['descricao'];
        $ret['ean'] = $produtos[0]['ean'];
        $ret['url_imagem'] = $produtos[0]['url_imagem'];
        $ret['quantidade'] = $estoque[0]['quantidade'];
        $data = explode('T', $estoque[0]['updated_at']);
        $data = explode('-', $data[0]);
        $ret['updated_at'] = $data[2] . '/' . $data[1] . '/' . $data[0];
        $ret['quantidade_real'] = '';
        $ret['justificativa'] = '';

        return $ret;
    }
}
