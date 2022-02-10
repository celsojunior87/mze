<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituicaoFinanceira extends Model
{
    use HasFactory;

    public $table = 'tb_instituicoes_financeiras';

    public $fillable = ['nome', 'descricao', 'codigo'];


    public function contasBancarias()
    {
        return $this->hasMany(ContaBancaria::class, 'instituicoes_financeiras_id', 'id');
    }
}
