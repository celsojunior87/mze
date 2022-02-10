<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\SocioPainelRequest;


interface SocioPainelInterface
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
     * @param   \App\Http\Requests\SocioPainelRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/socio      For Create
     * @method  PUT     api/socio/{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(SocioPainelRequest $request, $id = null);

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
}
