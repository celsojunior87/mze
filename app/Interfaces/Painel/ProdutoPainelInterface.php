<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\ProdutoRequest;
use Illuminate\Http\Request;

interface ProdutoPainelInterface
{




    /**
     * Get all Produtos
     *
     * @method  GET api/produtos
     * @access  public
     */
    public function getAll();


    public function search(Request $request);

    /**
     * Create | Update Produtos
     *
     * @param   \App\Http\Requests\ProdutoRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/departamento       For Create
     * @method  PUT     api/departamento /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(ProdutoRequest $request, $id = null);

    /**
     * Delete Produtos
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/produto /{id}
     * @access  public
     */
    public function delete($id);


    public function toDataTable(Request $request);

}

