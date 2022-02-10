<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secao extends Model
{
    use HasFactory;

    public $table = 'tb_secoes';

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamentos_id', 'id');
    }
    public function produto()
    {
        return $this->hasMany(Produto::class, 'secoes_id');
    }
}
