<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\SocioAppRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Interfaces\Cliente\ClienteInterface;
use App\Models\Cliente;
use App\Traits\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    use Response;

    public function __construct(Cliente $user, ClienteInterface $Userinterface)
    {
        $this->model = $user;
        $this->userInterface = $Userinterface;
    }

    /**
     * Cadastro dos Clientes
     */

    public function registration(ClienteRequest $request)
    {
        return $this->userInterface->registration($request);
    }

    public function Login(Request $request)
    {
        return $this->mainLogin($request, $this->model, 'cliente');
    }


    public function updateCustom(UsuarioUpdateRequest $request)
    {
        try {
            $usuario = Cliente::find($request->user()->id);
            if ($usuario) {
                $usuario->update($request->all());
                return $this->success("Usuario Atualizado com Sucesso", $request->all());
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }
    }



    /**
     * Visualizar todos os Usuarios
     *
     */

    public function getAll()
    {
        return $this->userInterface->getAll();
    }

    /**
     * Visualizar apenas um departamento
     */
    public function find($id)
    {
        return $this->userInterface->findById($id);
    }



    public function destroy($id)
    {
        return $this->userInterface->delete($id);
    }
}
