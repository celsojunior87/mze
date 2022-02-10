<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaItem extends Model
{
    use HasFactory;



    public $table = 'tb_vendas_itens';

    protected $fillable = [
        'qt_pedida',
        'dt_atualizacao',
        'qt_atendida',
        'valor',
        'vl_desconto',
        'perc_desc',
        'perc_comissao',
        'vl_comissao',
        'vendas_id',
        'produtos_id',
        'filiais_id'
    ];

    public function venda()
    {

        return $this->belongsTo(Venda::class, 'vendas_id');
    }


    public function produto()
    {

        return $this->hasOne(Produto::class, 'id', 'produtos_id');
    }

    public function filial()
    {

        return $this->hasOne(Filial::class, 'id', 'filiais_id');
    }
}
