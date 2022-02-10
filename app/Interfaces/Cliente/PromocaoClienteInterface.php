<?php

namespace App\Interfaces\Cliente;



interface PromocaoClienteInterface
{

        /**
     * Get all Promocoes
     *
     * @method  GET api/promocoes
     * @access  public
     */
    public function getAll();

   
    public function search($request);



}
