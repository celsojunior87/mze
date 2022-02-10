<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CupomDesconto extends Model
{
    use HasFactory;

    public $table = "tb_cupom_descontos";


    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regioes_id', 'id');
    }

    public function vendas(){

        return $this->hasMany(Venda::class, 'id');
    }




}
