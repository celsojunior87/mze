<?php

namespace App\Interfaces\Socio;

use App\Http\Requests\SocioRequest;
use Illuminate\Http\Client\Request;

interface SocioInterface
{

    /**
     * Get all Sócios
     *
     * @method  GET api/socios     * @access  public
     */
    public function getAll();

    /**
     * Get Socios By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/socios/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update Socios
     *
     * @param   \App\Http\Requests\SocioRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/socio      For Create
     * @method  PUT     api/socio/{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(SocioRequest $request, $id = null);

    /**
     * Delete Sócios
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/socio/{id}
     * @access  public
     */
    public function delete($id);


    public function search($request);


    public function registration($request);

    public function updateDadosSocio($request);
}
