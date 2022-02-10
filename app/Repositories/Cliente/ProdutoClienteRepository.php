<?php

namespace App\Repositories\Cliente;


use App\Interfaces\Cliente\ProdutoClienteInterface;
use App\Models\Departamento;
use App\Models\Produto;
use App\Traits\Response;

class ProdutoClienteRepository implements ProdutoClienteInterface
{
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    use Response;



    public function getAll()
    {
        try {
            $result = $this->produto->getProdutosAndDepartamentos();
            return $this->success("Lista de Produtos", $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }



    public function search($request)
    {
        return $this->success("Lista de Produtos", $this->produto->search($request), 200);;
    }

    public function getByDepartment($request)
    {
        if (!$request->departamentos_id) return $this->error("O departamentos_id é obrigatória", 401);
        if (!$request->regiao_id) return $this->error("O regiao_id é obrigatória", 401);
        try {
            $departamentos = Departamento::where('id', $request->departamentos_id)
                ->whereHas('secao', function ($dep) use ($request) {
                    $dep->whereHas('produto', function ($prod) use ($request) {
                        $prod->whereHas('preco', function ($preco) use ($request) {
                            $preco->whereHas('regiao', function ($regiao) use ($request) {
                                $regiao->where('regioes_id', $request->regiao_id);
                            });
                        });
                    });
                })
                ->with(['secao', 'secao.produto', 'secao.produto.preco' => function ($preco) use ($request) {
                    $preco->whereHas('regiao', function ($regiao) use ($request) {
                        $regiao->where('regioes_id', $request->regiao_id);
                    });
                }])
                ->get();

            return $this->success("Lista de Produtos", $departamentos);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 401);
        }
    }
}
