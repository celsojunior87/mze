<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatClienteSocio extends Model
{
    use HasFactory;

    public $table = 'tb_chat_cliente_socio';

    protected $hidden = ['created_at', 'updated_at'];


    public function venda()
    {
        return $this->belongsTo(Venda::class, 'id');
    }
    public function socio()
    {
        return $this->belongsTo(Socio::class, 'id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id');
    }


    // public function getDtEnvioAttribute($value)
    // {
    //     return (new Carbon($value))->format('d/m/y H:i:s');
    // }
    //
    //    public function setDtEnvioAttribute()
    //    {
    //        return $this->attributes['dt_envio'];
    //    }
}
