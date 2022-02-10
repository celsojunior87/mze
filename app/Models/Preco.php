<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
    use HasFactory;


    public $table = "tb_precos";

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produtos_id', 'id');
    }

    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regioes_id', 'id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id');
    }

    public function secao()
    {
        return $this->belongsTo(Secao::class, 'id');
    }

    public function getPrecoAttribute($preco)
    {
        return floatval($preco);
    }
}
