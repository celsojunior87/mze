<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $hidden = array('created_at', 'updated_at');

    public $table = 'tb_enderecos';

    public $fillable = ['cep', 'endereco', 'numero', 'uf', 'bairro', 'cidade', 'complemento', 'tipo'];


    //protected $appends = ['mix_id'];

    public function venda()
    {
        return $this->belongsTo(Venda::class,  'id');
    }
}
