<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\PrecoRequest;

interface PrecoPainelInterface
{
    /**
     * Get all preco
     *
     * @method  GET api/preco
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/preco/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update mix
     *
     * @param   \App\Http\Requests\PrecoRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/preco       For Create
     * @method  PUT     api/preco /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(PrecoRequest $request, $id = null);

    /**
     * Delete user
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/preco /{id}
     * @access  public
     */
    public function delete($id);
}
