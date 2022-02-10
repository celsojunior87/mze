<?php

namespace App\Interfaces\All;

use App\Http\Requests\FilialRequest;

interface FilialInterface
{
    /**
     * Get all Filiais
     *
     * @method  GET api/filiais
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/filial/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update Filiais
     *
     * @param   \App\Http\Requests\FilialRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/filial       For Create
     * @method  PUT     api/filial /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(FilialRequest $request, $id = null);

    /**
     * Delete filial
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/filial /{id}
     * @access  public
     */
    public function delete($id);
}
