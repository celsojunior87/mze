<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\DB;

class Cliente extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;



    public $table = 'tb_clientes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'email',
        'password',
        'cpf',
        'telefone',
        'password',
        'situacao'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @param $email
     * @return mixed
     */
    public function existByEmail($email)
    {
        return $this->where(['email' => $email])->exists();
    }


    /**
     * @param $cpf
     * @return mixed
     */
    public function existByCPF($cpf)
    {
        return $this->where(['cpf' => $cpf])->exists();
    }

    public function sendPasswordResetNotification($token)
    {

        $url = 'localhost:8000/reset?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    }


    public function getUsuariosAndEnderecos()
    {

        $result = DB::table('tb_clientes as cliente')
            ->join('tb_enderecos as enderecos', 'cliente.id', '=', 'enderecos.clientes_id')
            ->join('tb_regioes as regioes', 'enderecos.regioes_id', '=', 'regioes.id')
            ->select(
                'enderecos.cep as cep',
                'enderecos.bairro',
                'enderecos.cidade',
                'enderecos.uf',
                'enderecos.complemento',
                'regioes.descricao as regiao',
            )
            ->get();
        return $result;
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class, 'id');
    }
}
