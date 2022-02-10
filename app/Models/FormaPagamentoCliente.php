<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cobrancaClienteCliente extends Model
{
    use HasFactory;

    public $table = 'tb_forma_pagamento_clientes';


    public function cliente()
    {
        return $this->hasMany(Cliente::class, 'clientes_id', 'id');
    }

    public function TipoPagamento()
    {
        return $this->hasMany(TipoPagamento::class, 'tipo_pagamento_id', 'id');
    }
}
