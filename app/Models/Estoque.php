<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    public $table = 'tb_estoque';

    protected $fillable = [
        'produtos_id', 'quantidade', 'filiais_id',
    ];

    public function produto()
    {
        return $this->hasOne(Produto::class, 'id', 'produtos_id');
    }
}
