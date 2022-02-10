<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MixItem extends Model
{
    use HasFactory;


    public $table = "tb_mix_itens";

    public function produto(){
        return $this->belongsTo(Produto::class, 'produtos_id');
    }
}
