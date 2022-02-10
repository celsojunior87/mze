<?php

namespace App\Http\Controllers\Api\Painel;

use App\Http\Controllers\Controller;
use App\Http\Requests\RetaguardaRequest;
use App\Models\Administrador;
use App\Notifications\AdminEmailNotification;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PainelController extends Controller
{

    use Response;

    public function __construct(Administrador $model)
    {
        $this->model = $model;
    }

    public function login(Request $request)
    {
        return $this->mainLogin($request, $this->model, 'administrador');
    }

    public function toDataTable(Request $request)
    {
        $sort = $request->sort ?? 'nome';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';

        $result = Administrador::where('id', '<>', auth()->user()->id)
            ->orderBy($sort, $dir)
            ->paginate($items);

        return $result;
    }

    public function store(RetaguardaRequest $request)
    {
        return $this->saveOrUpdate($request);
    }

    public function update(RetaguardaRequest $request, $id = null)
    {
        return $this->saveOrUpdate($request, $id);
    }

    public function saveOrUpdate(RetaguardaRequest $request, $id = null)
    {

        // if($id === auth())

        try {
            $data = $request->all();
            $user = empty($id) ? new Administrador() : Administrador::findOrFail($id);
            $user->cpf = $data['cpf'];
            $user->nome = $data['nome'];
            $user->status = $data['status'] == '1' ? true : false;

            if (!empty($data['password'])) {
                $user->password = bcrypt($data['password']);
            }

            if (!$user->exists) {
                $user->email = $data['email'];
                $user->save();
                $user->notify(new AdminEmailNotification($user));
            }

            if ($user->exists && $user->email != $data['email']) {
                $user->email_verified_at = null;
                $user->email = $data['email'];
                $user->notify(new AdminEmailNotification($user));
            }

            $user->save();

            DB::commit();
            return $this->success(
                $id !== null ? "Usuário Atualizado com sucesso"
                    : "Usuário Criado com sucesso",
                $user,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 400);
        }
    }

    public function search(Request $request)
    {
        try {
            $result = Administrador::when($request->input('id'), function ($q) use ($request) {
                $q->where('id', $request->id);
            })->get();

            return $this->success('Listagem de usuários.', $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $result = Administrador::findOrFail($id);
            if ($result) {
                $result->delete();
            }

            return $this->success("Usuário deletado com Sucesso", $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
