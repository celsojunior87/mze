<?php

namespace App\Repositories\Socio;


use App\Interfaces\Socio\FilialInterface;
use App\Models\Filial;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FilialSocioRepository implements FilialInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function __construct(Filial $model)
    {
        $this->model = $model;
    }

    public function search($request)
    {
        $user = Auth::id();

        if (!$user) {

            return response()->json(['error' => 'O Usuário não esta autenticado no sistema, por favor fazer o login'], 402);
        }

        $cobraca = Filial::where('socios_id', $user)->get();
        return $this->success(
            "Listas de formas de pagamentos",
            $cobraca,
            200
        );
    }


    public function open($request)
    {
        DB::beginTransaction();
        try {
            if (!$request->id_filial && !isset($request->filial_aberta)) {
                return response()->json(['message' => 'Para abrir a filial deve passar o id da filial e a filial aberta'], 402);
            }
            Filial::where('id', $request->filial_id)
                ->update(['filial_aberta' => $request->filial_aberta]);
            DB::commit();
            if ($request->filial_aberta == false) {
                return $this->success('A Filial está fechada.', 200);
            }
            return $this->success('A Filial está aberta.', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }
    }
}
