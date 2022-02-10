<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaBancaria extends Model
{
    use HasFactory;

    public $table = 'tb_contas_bancarias';
    public $fillable = ['nome', 'titular', 'agencia', 'telefone', 'num_conta', 'cpf', 'instituicoes_financeiras_id'];


    public function instituicaoFinanceira()
    {
        return $this->belongsTo(InstituicaoFinanceira::class, 'instituicoes_financeiras_id');
    }

    public function socio()
    {
        return $this->belongsTo(Socio::class, 'socios_id');
    }
}
