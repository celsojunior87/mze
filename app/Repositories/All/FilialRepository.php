<?php

namespace App\Repositories\All;

use App\Http\Requests\FilialRequest;
use App\Interfaces\All\FilialInterface;
use App\Models\Endereco;
use App\Models\Filial;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use App\Traits\ImageHandler;

class FilialRepository implements FilialInterface
{
    // Use ResponseAPI Trait in this repository
    use Response, ImageHandler;

    public function __construct(Filial $model)
    {
        $this->model = $model;
    }


    public function getAll()
    {
        try {
            $filial = $this->model->with('regiao', 'socio', 'endereco')->paginate(10);
            return $this->success("Lista de Filiais", $filial);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $filial = $this->model->with('regiao', 'socio', 'endereco')->find($id);
            if (!$filial) return $this->error("Não Possui filiais $id", 404);
            return $this->success("Detalhes das filiais", $filial);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function saveOrUpdate(FilialRequest $request, $id = null)
    {

        DB::beginTransaction();
        try {
            $filial = $id ? Filial::find($id) : new Filial();
            if ($id && !$filial) return $this->error("Não Possui a Filial $id", 404);

            $filial->descricao = $request->descricao;
            $filial->cnpj = $request->cnpj;
            $filial->socios_id = $request->socios_id;
            $filial->tipo_filial = $request->tipo_filial;
            $filial->token_filial = md5($filial->cnpj . $request->endereco['endereco']);
            $filial->ativo = $request->ativo == 'true'  ? 1 : 0;


            //Cria endereco
            $endereco = $filial->endereco ?? new Endereco();
            $endereco->cep = $request->endereco['cep'];
            $endereco->endereco = strtoupper($request->endereco['endereco']);
            $endereco->numero = $request->endereco['numero'];
            $endereco->uf = $request->endereco['uf'];
            $endereco->bairro = strtoupper($request->endereco['bairro']);
            $endereco->cidade = strtoupper($request->endereco['cidade']);
            $endereco->complemento = strtoupper($request->endereco['complemento']);
            $endereco->tipo = 'FILIAL';
            $endereco->latitude = $request->endereco['latitude'];
            $endereco->longitude = $request->endereco['longitude'];
            $endereco->descricao = $request->endereco['descricao'];
            $endereco->regioes_id = $request->endereco['regioes_id'];
            $endereco->save();

            $filial->enderecos_id = $endereco->id;

            if ($request->input('url_imagem')) {

                $urlImage = $this->createUrlImagem($request->url_imagem, "Foto_" . $request->cnpj, 'filiais');

                if (empty($urlImage)) {
                    return  $this->error("A imagem não é válida. Verifique o arquivo enviado", 400);
                }

                $filial->url_imagem = $urlImage;
            }

            $filial->save();


            DB::commit();
            return $this->success(
                $id ? "Filial Atualizado com sucesso"
                    : "Filial Criado com sucesso",
                $filial,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $filial = Filial::find($id);

            // Check the endereço
            if (!$filial) return $this->error("Não Existe a filial $id", 404);
            $filial->ativo = 0;
            $filial->save();


            // Deleta o endereço
            $filial->delete();
            DB::commit();
            return $this->success("Filial deletado com Sucesso", $filial);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 500);
        }
    }
}
