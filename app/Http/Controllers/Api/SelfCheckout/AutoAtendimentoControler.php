<?php

namespace App\Http\Controllers\Api\SelfCheckout;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\Filial;
use App\Models\Socio;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AutoAtendimentoControler extends Controller
{

    public function __construct(Administrador $administrador)
    {
        $this->model = $administrador;
    }

    use Response;

    public function activate(Request $request)
    {
        $requestLogin = $this->mainLogin($request, $this->model, 'administrador');

        $response = json_decode($requestLogin->getContent(), true);
        if (!$response['sucesso']) {
            return $requestLogin;
        }

        $filial = Filial::where(['token_filial' => $request->token_filial])->get()->toArray();

        if (!$filial) {
            return response()->json(['message' => 'Filial Não Encontrada']);
        }

        $idAdmin = $response['dados']['user']['id'];
        try {
            Filial::where('id', $filial[0]['id'])->update(array('administrador_id' => $idAdmin, 'ativo' => '1'));

            $dadosFilial = Filial::where('id', $filial[0]['id'])->where('tipo_filial', 2)->with('endereco')->get();
            return $this->success("Detalhes da Filial", $dadosFilial);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 401);
        }
    }

    public function search(Request $request)
    {
        if (!$request->token_filial) {
            return $this->error(['erro' => 'O token é obrigatório.'], 401);
        }
        $filial = Filial::where('token_filial', $request->token_filial)->get()->toArray();

        if ($filial) {
            return $this->success("Detalhes da Filial", $filial);
        } else {
            return $this->error(['erro' => 'Filial não encontrada.'], 401);
        }
    }
}
