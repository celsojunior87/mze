<?php

namespace App\Interfaces\Cliente;

use App\Http\Requests\EnderecoRequest;
use Illuminate\Http\Request;

interface EnderecoClienteInterface
{

    /**
     * Get all Endereços
     *
     * @method  GET api/endereco     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/endereco/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update Endereços
     *
     * @param   \App\Http\Requests\EnderecoRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/endereco      For Create
     * @method  PUT     api/endereco/{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(EnderecoRequest $request, $id = null);

    /**
     * Delete Endereço
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/endereco/{id}
     * @access  public
     */
    public function delete($id);

    public function search(Request $request);

}
