<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;

    public $table = 'tb_auditoria';

    protected $fillable = [
        'qt_atual',
        'qt_contagem',
        'justificativa',
        'dt_contagem'
    ];
}
