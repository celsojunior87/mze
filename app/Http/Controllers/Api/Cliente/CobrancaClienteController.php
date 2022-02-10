<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\CobrancaClienteRequest;
use App\Interfaces\Cliente\CobrancaClienteInterface;
use Illuminate\Http\Request;

class CobrancaClienteController extends Controller
{


    public function __construct(CobrancaClienteInterface $cobranCliente)
    {
        $this->cobrancaCliente = $cobranCliente;
    }

    /**
     * Visualizar todos as formas de pagamento
     *
     */

    public function getAll()
    {

        return $this->cobrancaCliente->getAll();
    }

    /**
     * Visualizar apenas um departamento
     */
    public function find($id)
    {
        return $this->cobrancaCliente->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\CobrancaClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CobrancaClienteRequest $request)
    {
        return $this->cobrancaCliente->saveOrUpdate($request);
    }

    /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\CobrancaClienteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CobrancaClienteRequest $request, $id)
    {
        return $this->cobrancaCliente->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->cobrancaCliente->delete($id);
    }

    public function search(Request $request)
    {
        return $this->cobrancaCliente->search($request);
    }
}
