<?php


namespace App\Interfaces;

use App\Http\Requests\ChatClienteSocioRequest;
use Illuminate\Http\Request;

interface ChatClienteSocioInterface
{


    /**
     * Get all users
     *
     * @method  GET api/chat
     * @access  public
     */
    public function getAll(Request $request);

    /**
     * Get User By ID
     *
     * @param integer $id
     *
     * @method  GET api/chat/{
     * id
     * }
     * @access  public
     */
    public function findById($id);



    public function saveOrUpdate(ChatClienteSocioRequest $request);

    //public function search(Request $request,$id);


}
