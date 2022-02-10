<?php

namespace App\Interfaces\Cliente;

use App\Http\Requests\TipoPagamentoRequest;

interface TipoPagamentoClienteInterface
{
    /**
     * Get all tipo-pagamento
     *
     * @method  GET api/tipo-pagamento
     * @access  public
     */
    public function getAll();


}
