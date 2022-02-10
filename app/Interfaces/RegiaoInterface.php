<?php

namespace App\Interfaces;

use App\Http\Requests\RegiaoRequest;


interface RegiaoInterface 
{

      /**
     * Get all Regiao
     * 
     * @method  GET api/regiao     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     * 
     * @param   integer     $id
     * 
     * @method  GET api/regiao/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update Endereços
     * 
     * @param   \App\Http\Requests\RegiaoRequest    $request
     * @param   integer                           $id
     * 
     * @method  POST    api/regiao      For Create
     * @method  PUT     api/regiao/{id}  For Update     
     * @access  public
     */
    public function saveOrUpdate(RegiaoRequest $request, $id = null);

    /**
     * Delete Endereço
     * 
     * @param   integer     $id
     * 
     * @method  DELETE  api/regiao/{id}
     * @access  public
     */
    public function delete($id);

}