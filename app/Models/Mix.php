<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mix extends Model
{
    use HasFactory;


    public $table = "tb_mix";


    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'tb_mix_itens', 'mix_id', 'produtos_id');
    }

    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regioes_id');
    }
}
