<?php


namespace App\Interfaces\Cliente;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Client\Request;

interface ClienteInterface
{



    /**
     * Get all users
     *
     * @method  GET api/cliente
     * @access  public
     */
    public function getAll();

    /**
     * Get User By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/users/{id}
     * @access  public
     */
    public function findById($id);


    /**
     * Delete user
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/users /{id}
     * @access  public
     */
    public function delete($id);



    public function saveOrUpdate(ClienteRequest $request, $id = null);

    public function registration(ClienteRequest $request);
}
