<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Auth\AuthenticationException;

class Authenticate
{
    public function handle($request, Closure $next, ...$scopes)
    {
        if (!$request->user()) {
            return response(["sucesso" => false, "message" => "Usuário não encontrado na base de dados."], 401);
        }

        if (!$request->user()->token()) {
            return response(["sucesso" => false, "message" => "Token inválido ou expirado."], 401);
        }

        foreach ($scopes as $scope) {
            if ($request->user()->tokenCan($scope)) {
                return $next($request);
            }
        }

        return response(["sucesso" => false, "message" => "Usuário sem acesso ao recurso solicitado."], 401);
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }

    protected function unauthenticated()
    {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
