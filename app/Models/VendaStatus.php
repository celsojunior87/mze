<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaStatus extends Model
{
    use HasFactory;

    public $table = 'tb_vendas_status';

    protected $fillable = [
        'vendas_id', 'status_id', 'dt_atualizacao', 'ativo'
    ];
}
