<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\DepartamentoRequest;

interface DepartamentoPainelInterface
{
    /**
     * Get all Departamentos
     * 
     * @method  GET api/departamento
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     * 
     * @param   integer     $id
     * 
     * @method  GET api/departamentos/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update Departamentos
     * 
     * @param   \App\Http\Requests\DepartamentoRequest    $request
     * @param   integer                           $id
     * 
     * @method  POST    api/departamento       For Create
     * @method  PUT     api/departamento /{id}  For Update     
     * @access  public
     */
    public function saveOrUpdate(DepartamentoRequest $request, $id = null);

    /**
     * Delete user
     * 
     * @param   integer     $id
     * 
     * @method  DELETE  api/departamento /{id}
     * @access  public
     */
    public function delete($id);
}