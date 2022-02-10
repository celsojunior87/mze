<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\CupomDescontoRequest;

interface PainelCupomDescontoInterface
{
    /**
     * Get all Cupom de Desconto
     *
     * @method  GET api/cupom-desconto
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/cupom/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update Filiais
     *
     * @param   \App\Http\Requests\CupomDescontoRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/cupom-desconto       For Create
     * @method  PUT     api/cupom-desconto /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(CupomDescontoRequest $request, $id = null);

    /**
     * Delete cupom-desconto
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/cupom-desconto /{id}
     * @access  public
     */
    public function delete($id);
}
