<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;


    public $table = 'tb_status';


    public function venda()
    {
        return $this->belongsToMany(Venda::class, 'tb_vendas_status', 'status_id', 'vendas_id');
    }


    public function vendaStatus()
    {
        return $this->hasMany(VendaStatus::class, 'status_id','id');
    }
}
