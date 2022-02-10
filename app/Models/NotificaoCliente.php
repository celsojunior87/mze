<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificaoCliente extends Model
{
    use HasFactory;

    protected $appends = ['tipo'];

    public $table = 'tb_notificacoes_cliente';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id', 'id');
    }

    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regioes_id', 'id');
    }

    public function getTipoAttribute()
    {
        return 'CLIENTES';
    }
}
