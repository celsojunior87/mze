<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Promocao extends Model
{
    use HasFactory;

    public $table = "tb_promocoes";


    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regioes_id', 'id');
    }



}
