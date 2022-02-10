<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaItem extends Model
{
    use HasFactory;

    public $table = 'tb_auditoria_itens';

    protected $fillable = [
        'descricao',
        'tipo',
        'dt_criacao',
        'dt_finalizacao'
    ];
}
