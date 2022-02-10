<?php

namespace App\Interfaces\Cliente;


use App\Http\Requests\CobrancaClienteRequest;
use Illuminate\Http\Request;

interface CobrancaClienteInterface
{
    /**
     * Get all Formas de Pagamentos dos clientes
     *
     * @method  GET api/
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api//{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update Departamentos
     *
     * @param   \App\Http\Requests\CobrancaClienteRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/       For Create
     * @method  PUT     api/ /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(CobrancaClienteRequest $request, $id = null);

    /**
     * Delete user
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/ /{id}
     * @access  public
     */
    public function delete($id);


    public function search(Request $request);
}
