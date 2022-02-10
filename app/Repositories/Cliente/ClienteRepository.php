<?php

namespace App\Repositories\Cliente;

use App\Http\Requests\ClienteRequest;
use App\Interfaces\Cliente\ClienteInterface;
use App\Models\Endereco;
use App\Models\Cliente;
use App\Models\EnderecoCliente;
use App\Notifications\ClienteEmailNotification;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use Illuminate\Support\Facades\Validator;

class ClienteRepository implements ClienteInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;


    public function __construct(Cliente $user)
    {
        $this->model = $user;
    }

    public function registration(ClienteRequest $request)
    {

        if (isset($request->cpf)) {
            if ($this->model->existByCPF($request->cpf)) {
                $validator = Validator::make([], []);
                return response()->json(['message' => 'Cpf existente na base dados'], 400);
            }
        }


        $data = $request->all();

        $data['password'] = bcrypt($data['password']);
        $user = Cliente::create($data);

        $endereco = $this->createEndereco($request['endereco']);
        $endereco->save();

        $enderecosClientes = $this->createEnderecosClientes($user->id, $endereco->id);
        $enderecosClientes->save();

        $resArr = [];
        $resArr['token'] = $user->createToken('api-application')->accessToken;
        $resArr['nome'] = $user->nome;
        $resArr['cpf'] = $user->cpf;

        $user->notify(new ClienteEmailNotification($user));

        return response()->json($resArr, 200);
    }

    public function createEnderecosClientes($userId, $enderecoId)
    {
        $enderecoCliente = new EnderecoCliente();
        $enderecoCliente->clientes_id = $userId;
        $enderecoCliente->enderecos_id = $enderecoId;

        return $enderecoCliente;
    }

    public function createEndereco($arrEnderecos)
    {
        $endereco = new Endereco();
        $endereco->cep = $arrEnderecos['cep'];
        $endereco->endereco = $arrEnderecos['endereco'];
        $endereco->numero = $arrEnderecos['numero'];
        $endereco->uf = $arrEnderecos['uf'];
        $endereco->bairro = $arrEnderecos['bairro'];
        $endereco->cidade = $arrEnderecos['cidade'];
        $endereco->complemento = $arrEnderecos['complemento'];
        $endereco->tipo = $arrEnderecos['tipo'];
        $endereco->latitude = $arrEnderecos['latitude'];
        $endereco->longitude = $arrEnderecos['longitude'];
        $endereco->descricao = $arrEnderecos['descricao'];

        $regioes_id = DB::select("select public.fnc_consulta_regiao('" . $arrEnderecos['latitude'] . "', '" . $arrEnderecos['longitude'] . "') as regioes_id");
        $endereco->regioes_id = $regioes_id[0]->regioes_id;
        return $endereco;
    }

    public function getAll()
    {

        try {
            $users = Cliente::all();
            return $this->success("Lista de Usuarios", $users);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function findById($id)
    {
        try {
            $users = $this->model->with('enderecos')->find($id);
            if (!$users) return $this->error("Não Possui Usuarios na Base de Dados $id", 404);
            return $this->success("Detalhes do Departamento", $users);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function saveOrUpdate(ClienteRequest $request, $id = null)
    {


        DB::beginTransaction();
        try {
            $users = $id ? Cliente::find($id) : new Cliente();
            if ($id && !$users) return $this->error("Não Possui Usuários $id", 404);
            $users->nome = $request->nome;
            $users->email = $request->email;
            $users->cpf = $request->cpf;
            $users->telefone = $request->telefone;
            $users->password = $request->password;
            //$users->situacao = $request->situacao;
            // Save the user
            $users->save();

            DB::commit();
            return $this->success(
                $id ? "Usuário Atualizado com sucesso"
                    : "Usuário Criado com sucesso",
                $users,
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
            $users = Cliente::find($id);

            // Check the user
            if (!$users) return $this->error("Não Existe o Usuário $id", 404);

            // Delete the user
            $users->delete();
            DB::commit();
            return $this->success("Usuario deletado com Sucesso", $users);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
