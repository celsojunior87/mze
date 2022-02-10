<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\MixItemRequest;
use Illuminate\Http\Request;

interface MixItemPainelInterface
{
    /**
     * Get all mix
     *
     * @method  GET api/mix-item
     * @access  public
     */
    public function getAll(Request $request);

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/mix-item/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update mix
     *
     * @param   \App\Http\Requests\MixItemRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/mix-item       For Create
     * @method  PUT     api/mix-item /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(MixItemRequest $request, $id = null);

    /**
     * Delete user
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/mix-item /{id}
     * @access  public
     */
    public function delete($id);
}
