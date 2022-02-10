<?php

namespace App\Interfaces\Painel;


use App\Http\Requests\PromocaoRequest;
use App\Http\Requests\StatusRequest;

interface StatusPainelInterface
{

    /**
     * Get all Status
     *
     * @method  GET api/status
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/produtos/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update Produtos
     *
     * @param   \App\Http\Requests\StatusRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/promocao       For Create
     * @method  PUT     api/promocao /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(StatusRequest $request, $id = null);

    /**
     * Delete Produtos
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/promocao/{id}
     * @access  public
     */
    public function delete($id);

    /**
     * Visualizar todos os promocao
     *
     */
    public function search($request);
}
