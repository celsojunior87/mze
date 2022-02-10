<?php

namespace App\Http\Controllers;

use App\Models\Filial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function mainLogin(Request $request, Model $model, $scope)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), $this->loginValidateRules(), $this->loginValidateMessages());

        if ($validator->fails()) {
            return  response()->json(["sucesso" => false, "message" => $validator->errors()->first()], 400);
        }

        if ($model::where('email', $email)->count() <= 0) return response(["sucesso" => false, "message" => "E-mail não encontrado"], 401);

        $user = $model::when($scope == 'socio', function ($q) {
            $q->with('filial', 'endereco');
        })
            ->where('email', $email)->first();

        if (password_verify($password, $user->password)) {

            if (!$user->hasVerifiedEmail()) {
                return response(
                    [
                        "sucesso" => false,
                        "message" => "E-mail não verificado. Acesse sua caixa de entrada e clique no link enviado no momento do cadastro.",
                        "dados" => [
                            "email" => $email
                        ]
                    ],
                    401
                );
            }

            return response(
                [
                    "sucesso" => true,
                    "message" => "Autorizado",
                    "dados" => [
                        "token" => $user->createToken('token-api-' . $scope, [$scope])->accessToken,
                        "user" => $user,
                    ]
                ],
                200
            );
        }

        return response(
            [
                "sucesso" => false,
                "message" => "Dados incorretos"
            ],
            401
        );
    }


    protected function client(Request $request)
    {


        $user =  $request->user();
        $filial = Filial::where('socios_id', $request->user()->id)->first();

        $user->filial = $filial;

        return response(
            [
                "sucesso" => true,
                "message" => "Autorizado",
                "dados" => $user
            ],
            201
        );
    }

    protected function loginValidateRules()
    {
        return  [
            'email' => 'required|email:rfc,dns|max:255',
            'password' => ['required'],
        ];
    }

    protected function loginValidateMessages()
    {
        return [
            'email:required' => 'E-mail não informado',
            'email:required' => 'E-mail não informado',
            'password:required' => 'Senha não informada'
        ];
    }
}
