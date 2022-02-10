<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacaoSocio extends Model
{
    use HasFactory;

    protected $table = "tb_notificacoes_socio";

    protected $appends = ['tipo'];

    public function socio()
    {
        return $this->belongsTo(Socio::class, 'socios_id', 'id');
    }

    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regioes_id', 'id');
    }

    public function getTipoAttribute()
    {
        return 'SÓCIOS';
    }
}
