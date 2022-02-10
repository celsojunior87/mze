<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilaVendaFilial extends Model
{
    use HasFactory;

    public  $table = "tb_filas_vendas_filiais";

    public $fillable = ['vendas_id', 'filiais_id', 'dt_fila', 'dt_aceite', 'dt_rejeicao'];

    public function venda()
    {
        return $this->belongsTo(Venda::class, 'id');
    }

    public function filial()
    {

        return $this->hasOne(Filial::class, 'id', 'filiais_id');
    }

    public function cliente()
    {

        return $this->belongsTo(Cliente::class, 'clientes_id', 'id');
    }
}
