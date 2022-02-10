<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    use HasFactory;


    public $table = "tb_regioes";


    public $fillable = ['descricao', 'longitude', 'latitude'];



    public function socio()
    {
        return $this->belongsTo(Socio::class, 'socios_id', 'id');
    }

    public function promocao()
    {
        return $this->belongsTo(Promocao::class, 'id');
    }

    public function cupomDesconto()
    {
        return $this->belongsTo(CupomDesconto::class, 'id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }

    public function mix()
    {
        return $this->hasMany(Mix::class, 'regioes_id');
    }
}
