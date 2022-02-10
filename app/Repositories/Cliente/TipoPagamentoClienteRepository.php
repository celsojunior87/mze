<?php

namespace App\Repositories\Cliente;

use App\Http\Requests\TipoPagamentoRequest;
use App\Interfaces\Cliente\TipoPagamentoClienteInterface;
use Illuminate\Support\Facades\DB;
use App\Models\TipoPagamento;
use App\Traits\Response;

class TipoPagamentoClienteRepository implements TipoPagamentoClienteInterface
{
    public function __construct(TipoPagamento $tipoPagamento)
    {
        $this->TipoPagamento = $tipoPagamento;
    }

    use Response;

    public function getAll()
    {
        try {
            $tipoPagamento = TipoPagamento::all();
            return $this->success("Lista de Tipo Pagamento", $tipoPagamento);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }


}
