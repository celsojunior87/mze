<?php

namespace App\Repositories\SelfCheckout;

use App\Interfaces\SelfCheckout\ProdutoAutoAtendimentoInterface;
use App\Models\Produto;
use App\Traits\Response;

class ProdutoAutoAtendimentoRepository implements ProdutoAutoAtendimentoInterface
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
        return $this->produto->search($request);
    }

}
