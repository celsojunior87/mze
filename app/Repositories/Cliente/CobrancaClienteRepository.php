<?php

namespace App\Repositories\Cliente;

use App\Http\Requests\cobrancaClienteClienteRequest;
use App\Http\Requests\CobrancaClienteRequest;
use App\Interfaces\Cliente\CobrancaClienteInterface;
use App\Models\CobrancaCliente;
use App\Service\CardValidationService;
use App\Service\CieloService;
use Illuminate\Support\Facades\DB;
use App\Models\cobrancaClienteCliente;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CobrancaClienteRepository implements CobrancaClienteInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function __construct(CobrancaCliente $model, CieloService $cieloService, CardValidationService $cardValidationService)
    {
        $this->cardValidationService = $cardValidationService;
        $this->model = $model;
        $this->cieloService = $cieloService;
    }

    public function getAll()
    {
        try {
            $cobrancaCliente = CobrancaCliente::all();
            return $this->success("Lista de Cobranças de Cliente", $cobrancaCliente);
        } catch (\Exception $e) {
            return $this->error('Lista de Cobranças de Cliente');
        }
    }

    public function findById($id)
    {
        try {
            $cobrancaCliente = CobrancaCliente::find($id);
            if (!$cobrancaCliente) return $this->error("Não Possui  Cobranças de Cliente $id", 404);
            return $this->success("Detalhes da  Cobranças de Cliente", $cobrancaCliente);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function saveOrUpdate(CobrancaClienteRequest $request, $id = null)
    {
        $user = $request->user()->id;

        if (!$user) {

            return response()->json(['error' => 'O Usuário não esta autenticado no sistema, por favor fazer o login'], 401);
        }

        if (!empty($id)) {
            return $this->updateCobranca($id, $request->descricao);
        }

        DB::beginTransaction();
        try {
            $cobrancaCliente = $id ? CobrancaCliente::find($id) : new CobrancaCliente;

            if ($id && !$cobrancaCliente) return $this->error("Não Possui essa Cobrança de Clientes $id", 404);

            if ($request->numero_cartao && $user) {
                if ($this->model->existByNumeroCartao($request->numero_cartao, $user)) {
                    $validator = Validator::make([], []);
                    $validator->errors()->add('numero_cartao', 'O Número de Cartão existente na base de Dados');
                    return response()->json($validator->getMessageBag()->all(), 202);
                }
            }
            $cobrancaCliente->descricao = $request->descricao;
            $cobrancaCliente->numero_cartao = substr($request->numero_cartao, -4);
            $cobrancaCliente->dt_vencimento = $request->dt_vencimento;
            $cobrancaCliente->dt_ultima_atualizacao = now();
            $cobrancaCliente->titular = $request->titular;
            $cobrancaCliente->cgc = $request->cgc;
            $cobrancaCliente->endereco = $request->endereco;
            $cobrancaCliente->clientes_id = $user;
            $cobrancaCliente->tipos_cobrancas_id = $request->tipos_cobrancas_id;

            if ($request->tipos_cobrancas_id == 1 || $request->tipos_cobrancas_id == 2) {
                $cardToken = $this->cieloService->getTokenCard($request->titular, $request->numero_cartao, $request->dt_vencimento);
                $cobrancaCliente->token = $cardToken["token"];
            }

            $brand = $this->cardValidationService->valida_cartao($request->numero_cartao);
            $cobrancaCliente->bandeira_cartao = $brand["brand"];

            $cobrancaCliente->save();

            DB::commit();
            return $this->success(
                $id ? "Cobrança de Clientes Atualizado com sucesso"
                    : "Cobrança de Clientes Criado com sucesso",
                $cobrancaCliente,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function updateCobranca($id, $descricao)
    {

        DB::beginTransaction();
        try {
            $cobrancaCliente = $id ? CobrancaCliente::find($id) : new CobrancaCliente;

            if ($id && !$cobrancaCliente) return $this->error("Não Possui essa Cobrança de Clientes $id", 404);

            $cobrancaCliente->descricao = $descricao;

            $cobrancaCliente->save();

            DB::commit();

            return $this->success("Cobrança de Clientes Atualizado com sucesso", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $cobrancaCliente = CobrancaCliente::find($id);

            // Check the user
            if (!$cobrancaCliente) return $this->error("Não Existe Cobrança de Clientes $id", 404);

            // Delete the user
            $cobrancaCliente->delete();
            DB::commit();
            return $this->success("Cobrança de Clientes deletado com Sucesso", $cobrancaCliente);
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

        $cobraca = CobrancaCliente::where('clientes_id', $user)->get();
        return $this->success(
            "Listas de formas de pagamentos",
            $cobraca,
            200
        );
    }
}
