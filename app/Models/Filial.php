<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Filial extends Model
{
    use HasFactory;
    use SoftDeletes;


    public $table = "tb_filiais";


    protected $dates = ['dt_inativacao'];

    const DELETED_AT = 'dt_inativacao';

    public $fillable = ['descricao', 'cnpj', 'endereco', 'latitude', 'longetude', 'ativo', 'filial_aberta'];


    //protected $appends = ['mix_id'];


    public function socio()
    {
        return $this->belongsTo(Socio::class, 'socios_id', 'id');
    }

    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regioes_id', 'id');
    }


    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'enderecos_id');
    }
}
