<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Socio extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public $table = "tb_socios";


    public $fillable = ['nome', 'email', 'cpf', 'telefone', 'raio_entrega', 'url_foto', 'url_documento_frente', 'url_documento_verso', 'password'];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $cpf
     * @return mixed
     */
    public function existByCPF($cpf)
    {
        return $this->where(['cpf' => $cpf])->exists();
    }

    public function instituicaoFinanceira()
    {
        return $this->hasOne(InstituicaoFinanceira::class, 'id');
    }


    public function filial()
    {
        return $this->belongsTo(Filial::class, 'id');
    }


    public function filiais()
    {
        return $this->hasMany(Filial::class, 'socios_id');
    }

    public function contasBancarias()
    {
        return $this->hasMany(ContaBancaria::class, 'socios_id', 'id');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'enderecos_id');
    }

    public function setNomeAttribute($nome)
    {
        $this->attributes['nome'] = strtoupper($nome);
    }
}
