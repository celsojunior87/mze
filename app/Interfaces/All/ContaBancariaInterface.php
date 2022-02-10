<?php

namespace App\Interfaces\All;

use App\Http\Requests\ContaBancariaRequest;

interface ContaBancariaInterface
{
    /**
     * Get all contas
     *
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update contas
     *
     * @param   \App\Http\Requests\ContaBancariaRequest    $request
     * @param   integer                           $id
     *
     * @access  public
     */
    public function saveOrUpdate(ContaBancariaRequest $request, $id = null);

    /**
     * Delete conta
     *
     * @param   integer     $id
     *
     * @access  public
     */
    public function delete($id);
}
