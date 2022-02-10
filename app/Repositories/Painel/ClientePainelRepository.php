<?php

namespace App\Repositories\Painel;


use App\Interfaces\Painel\ClientePainelInterface;
use App\Models\Endereco;
use App\Models\Cliente;
use App\Traits\Response;


class ClientePainelRepository implements ClientePainelInterface
{
    // Use ResponseAPI Trait in this repository
    use Response;

    public function getAll()
    {
        try {
            $users = Cliente::all();
            return $this->success("Lista de Usuarios", $users);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
