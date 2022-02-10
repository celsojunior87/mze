<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    public $table = 'tb_estados';

    public function regioes()
    {
        return $this->hasMany(Regiao::class, 'estados_id');
    }
}
