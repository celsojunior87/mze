<?php

namespace App\Repositories\Cliente;

use App\Interfaces\Cliente\PromocaoClienteInterface;
use App\Models\Promocao;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use App\Traits\BaseUrlReturn;

class PromocaoClienteRepository implements PromocaoClienteInterface
{

    use Response, BaseUrlReturn;


    public function __construct(Promocao $promocao)
    {
        $this->promocao = $promocao;
    }

    public function getAll()
    {
        try {
            $promocao = $this->promocao->with('regiao')->paginate();
            return $this->success("Lista de Promoções", $promocao);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 403);
        }
    }

    public function search($request)
    {
        try {
            $promocao = Promocao::where('regioes_id', $request->regioes_id)
                ->with('regiao')->get();

            $dados = [];
            foreach ($promocao as $key => $promo) {
                $p['id'] = $promo->id;
                $p['descricao'] = $promo->descricao;
                $p['dt_inicial'] = $promo->dt_inicial;
                $p['dt_final'] = $promo->dt_final;
                $p['url_imagem'] = $this->getUrl($promo->url_imagem);
                $p['tipo'] = $promo->tipo;
                $p['regioes_id'] = $promo->regioes_id;
                $p['created_at'] = $promo->created_at;
                $p['updated_at'] = $promo->updated_at;
                $p['regiao']['id'] = $promo->regiao->id;
                $p['regiao']['descricao'] = $promo->regiao->descricao;
                $p['regiao']['latitude'] = $promo->regiao->latitude;
                $p['regiao']['longitude'] = $promo->regiao->longitude;
                $p['regiao']['raio_entrega'] = $promo->regiao->raio_entrega;
                $p['regiao']['estados_id'] = $promo->regiao->estados_id;
                $p['regiao']['created_at'] = $promo->regiao->created_at;
                $p['regiao']['updated_at'] = $promo->regiao->updated_at;

                $dados[$key] = $p;
            }


            if ($dados) {
                return $this->success("Lista de Promoções", $dados);
            } {
                return $this->success("Não existem promoções para esta região.", $dados);
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 403);
        }
    }
}
