<?php

namespace App\Interfaces\All;

use App\Http\Requests\InstituicaoFinanceiraRequest;
use Illuminate\Http\Request;

interface InstituicaoFinanceiraInterface
{
    /**
     * Get all Departamentos
     * 
     * @method  GET api/instituicao-financeira
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     * 
     * @param   integer     $id
     * 
     * @method  GET api/instituicao-financeira/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update Instituição financeira
     * 
     * 
     * @param   integer                           $id
     * 
     * @method  POST    api/departamento       For Create
     * @method  PUT     api/departamento /{id}  For Update     
     * @access  public
     */
    public function saveOrUpdate(InstituicaoFinanceiraRequest $request, $id = null);

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