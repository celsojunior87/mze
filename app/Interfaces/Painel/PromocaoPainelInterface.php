<?php

namespace App\Interfaces\Painel;


use App\Http\Requests\PromocaoRequest;


interface PromocaoPainelInterface
{

        /**
     * Get all Promocoes
     *
     * @method  GET api/promocoes
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
     * @param   \App\Http\Requests\PromocaoRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/promocao       For Create
     * @method  PUT     api/promocao /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(PromocaoRequest $request, $id = null);

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



}
