<?php

namespace App\Interfaces\Painel;


use App\Http\Requests\PromocaoRequest;
use App\Http\Requests\SecaoRequest;

interface SecaoPainelInterface
{

    /**
     * Get all Seções
     *
     * @method  GET api/secao
     * @access  public
     */
    public function getAll();

    /**
     * Get secao By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/secao/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update secao
     *
     * @param   \App\Http\Requests\SecaoRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/promocao       For Create
     * @method  PUT     api/promocao /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(SecaoRequest $request, $id = null);

    /**
     * Delete secao
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
