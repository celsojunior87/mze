<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    public $table = "tb_departamentos";

    protected $fillable = ['descricao', 'url'];

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'departamentos_id', 'id');
    }
    public function secao()
    {
        return $this->hasMany(Secao::class, 'departamentos_id', 'id');
    }
}
