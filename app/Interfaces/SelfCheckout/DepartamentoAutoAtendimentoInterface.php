<?php

namespace App\Interfaces\SelfCheckout;



interface DepartamentoAutoAtendimentoInterface
{
    /**
     * Get all Departamentos
     *
     * @method  GET api/departamento
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/departamentos/{id}
     * @access  public
     */
    public function findById($id);


    public function search($request);



  }
