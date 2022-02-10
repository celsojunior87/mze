<?php

namespace App\Repositories\Cliente;

use App\Http\Requests\EnderecoRequest;
use App\Interfaces\Cliente\EnderecoClienteInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Departamento;
use App\Models\Endereco;
use App\Models\EnderecoCliente;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;

class EnderecoClienteRepository implements EnderecoClienteInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;


    public function getAll()
    {
        try {
            $endereco = Endereco::all();
            return $this->success("Lista de Endereços", $endereco);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $endereco = Endereco::find($id);
            if (!$endereco) return $this->error("Não Possui Endereço $id", 404);
            return $this->success("Detalhes do Endereço", $endereco);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function saveOrUpdate(EnderecoRequest $request, $id = null)
    {

        $user = Auth::id();

        if (!$user) {

            return response()->json(['error' => 'O Usuário não esta autenticado no sistema, por favor fazer o login'], 402);
        }


        DB::beginTransaction();
        try {
            $endereco = $id ? Endereco::find($id) : new Endereco();
            if ($id && !$endereco) return $this->error("Não Possui o Departamento $id", 404);
            $endereco->descricao = $request->descricao;
            $endereco->cep = $request->cep;
            $endereco->complemento = $request->complemento;
            $endereco->endereco = $request->endereco;
            $endereco->numero = $request->numero;
            $endereco->uf = $request->uf;
            $endereco->bairro = $request->bairro;
            $endereco->cidade = $request->cidade;
            $endereco->tipo = $request->tipo;
            $endereco->latitude = $request->latitude;
            $endereco->longitude = $request->longitude;
            $regioes_id = DB::select("select public.fnc_consulta_regiao('" . $request->latitude . "', '" . $request->longitude . "') as regioes_id");
            $endereco->regioes_id = $regioes_id[0]->regioes_id;

            // Save the
            $endereco->save();

            $enderecoCliente = new EnderecoCliente();
            $enderecoCliente->clientes_id = $user;
            $enderecoCliente->enderecos_id = $endereco->id;
            $enderecoCliente->save();

            DB::commit();
            return $this->success(
                $id ? "Endereço Atualizado com sucesso"
                    : "Endereço Criado com sucesso",
                $endereco,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $endereco = Endereco::find($id);

            // Check the endereço
            if (!$endereco) return $this->error("Não Existe o Endereço $id", 404);

            // Deleta o endereço
            $endereco->delete();
            DB::commit();
            return $this->success("Endereço deletado com Sucesso", $endereco);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function search($request)
    {
        $user = Auth::id();

        if (!$user) {

            return response()->json(['error' => 'O Usuário não esta autenticado no sistema, por favor fazer o login'], 402);
        }

        $endereco = EnderecoCliente::where('clientes_id', $user)->get();

        if (empty($endereco[0])) {
            return $this->error("Não existe endereço cadastrado para este usuário", 200);
        }
        foreach ($endereco as $key => $end) {
            $dados = Endereco::where('id', $end['enderecos_id'])->get();
            $retorno[$key]['id'] = $dados[0]['id'];
            $retorno[$key]['descricao'] = $dados[0]['descricao'];
            $retorno[$key]['cep'] = $dados[0]['cep'];
            $retorno[$key]['endereco'] = $dados[0]['endereco'];
            $retorno[$key]['numero'] = $dados[0]['numero'];
            $retorno[$key]['bairro'] = $dados[0]['bairro'];
            $retorno[$key]['cidade'] = $dados[0]['cidade'];
            $retorno[$key]['complemento'] = $dados[0]['complemento'];
            $retorno[$key]['tipo'] = $dados[0]['tipo'];
            $retorno[$key]['latitude'] = $dados[0]['latitude'];
            $retorno[$key]['longitude'] = $dados[0]['longitude'];
            $retorno[$key]['regioes_id'] = $dados[0]['regioes_id'];
        }
        return $this->success(
            "Listas de endereços",
            $retorno,
            200
        );
    }
}
