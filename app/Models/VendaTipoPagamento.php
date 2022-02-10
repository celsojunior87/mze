<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaTipoPagamento extends Model
{
    use HasFactory;


    public $table = 'tb_vendas_tipos_pagamentos';


    public function venda()
    {

        return $this->hasMany(Status::class, 'vendas_id', 'id');
    }


    public function tipoCobrancas()
    {

        return $this->hasMany(TipoCo::class, 'tipo_pagamento_id', 'id');
    }
}
