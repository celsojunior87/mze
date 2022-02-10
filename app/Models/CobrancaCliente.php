<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobrancaCliente extends Model
{
    use HasFactory;


    public  $table = 'tb_cobrancas_clientes';



    /**
     * @param $cpf
     * @return mixed
     */
    public function existByNumeroCartao($numero_cartao, $id)
    {
        return $this->where([
            'numero_cartao' => $numero_cartao,
            'clientes_id' => $id,
        ])->exists();
    }
}
