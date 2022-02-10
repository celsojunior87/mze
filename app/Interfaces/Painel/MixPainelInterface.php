<?php

namespace App\Interfaces\Painel;

use App\Http\Requests\MixRequest;
use Illuminate\Http\Request;

interface MixPainelInterface
{
  
    /**
     * Get all mix
     *
     * @method  GET api/mix
     * @access  public
     */
    public function getAll(Request $request);

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/mix/{id}
     * @access  public
     */
    public function findById($id);

    /**
     * Create | Update mix
     *
     * @param   \App\Http\Requests\MixRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/mix       For Create
     * @method  PUT     api/mix /{id}  For Update
     * @access  public
     */
    public function saveOrUpdate(MixRequest $request, $id = null);

    /**
     * Delete user
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/mix /{id}
     * @access  public
     */
    public function delete($id);


    public function toDataTable(Request $request);

    public function productsToDataTable(Request $request, $mixId);

    public function updateLinkedProducts(Request $request, $mixId);
    
    public function unlinkProduct(Request $request, $mixId);
   
}
