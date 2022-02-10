<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnderecoRequest;
use App\Interfaces\Cliente\EnderecoClienteInterface;
use Illuminate\Http\Request;

class EnderecoClienteController extends Controller
{
    public function __construct(EnderecoClienteInterface $endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * Visualizar todos os endereços
     *
     */

    public function getAll()
    {

        return $this->endereco->getAll();
    }

    /**
     * Visualizar apenas um endereço
     */
    public function find($id)
    {
        return $this->endereco->findById($id);
    }

    /**
     * Salvar as informações no banco de dados
     *
     * @param  \Illuminate\Http\Requests\EnderecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnderecoRequest $request)
    {
        return $this->endereco->saveOrUpdate($request);
    }

    /**
     * Atualiza as instiuições financeiras
     *
     * @param  \App\Http\Requests\EnderecoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EnderecoRequest $request, $id)
    {
        return $this->endereco->saveOrUpdate($request, $id);
    }

    public function destroy($id)
    {
        return $this->endereco->delete($id);
    }

    public function search(Request $request)
    {
        return $this->endereco->search($request);
    }
}
