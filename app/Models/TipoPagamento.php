<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagamento extends Model
{
    use HasFactory;

    public $table = 'tb_tipos_pagamentos';

    public $fillable =['descricao','situacao'];


}
