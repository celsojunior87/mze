<?php

namespace App\Interfaces\Socio;

use App\Http\Requests\SocioAppRequest;
use App\Http\Requests\VendaStatusRequest;
use App\Http\Requests\VendaTrocaSocioRequest;

interface VendaStatusSocioInterface
{

    /**
     * Get all Sócios
     *
     * @method  GET api/venda-status     * @access  public
     */
    public function getAll();

    /**
     * Create | Update venda-status
     *
     * @param   \App\Http\Requests\VendaStatusSocioRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/venda-status      For Create
     * @method  PUT     api/venda-status/{id}  For Update
     * @access  public
     */
    public function update(VendaStatusRequest $request, $id = null);

    /**
     * Delete Sócios
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/venda-status/{id}
     * @access  public
     */
    public function delete($id);
}
