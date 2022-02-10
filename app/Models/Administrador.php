<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Administrador extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    public $table = 'tb_administradores';

    protected $fillable = [
        'nome',
        'email',
        'password',
        'cpf',
        'password',
        'status'

    ];

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

    public function setNomeAttribute($nome)
    {
        $this->attributes['nome'] = strtoupper($nome);
    }
}
