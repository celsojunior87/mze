<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Produto extends Model
{
    use HasFactory;

    public $table = 'tb_produtos';
    protected $appends = ['thumbnail'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamentos_id', 'id');
    }

    public function secao()
    {
        return $this->belongsTo(Secao::class, 'secoes_id', 'id');
    }

    public function mix()
    {
        return $this->belongsToMany(Mix::class, 'tb_mix_itens', 'produtos_id', 'mix_id');
    }

    public function getProdutosAndDepartamentos()
    {

        $result = DB::table('tb_produtos as produtos')
            ->join('tb_departamentos as departamento', 'produtos.departamentos_id', '=', 'departamento.id')
            ->select(
                'produtos.id',
                'produtos.titulo',
                'produtos.descricao_detalhada',
                'produtos.ean',
                'produtos.unidade',
                'departamento.descricao as departamento',
                'produtos.url_imagem'
            )
            ->paginate(10);

        return $result;
    }

    public function vendaItem()
    {

        return $this->belongsTo(VendaItem::class,  'id');
    }

    public function venda()
    {
        return $this->belongsToMany(Venda::class, 'tb_vendas_itens', 'produtos_id', 'vendas_id');
    }


    public function search($request)
    {
        $descricao = $request->input('descricao');

        $search = Produto::when($request->input('id'), function ($q) use ($request) {
            $q->where('id', $request->input('id'));
        })->when($request->input('descricao'), function ($q) use ($descricao) {
            $q->orWhereRaw("UPPER(descricao) LIKE '%" . strtoupper($descricao) . "%'")
                ->orWhereRaw("UPPER(titulo) LIKE '%" . strtoupper($descricao) . "%'");
        })->with('departamento')
            ->whereHas('departamento', function ($q) use ($descricao) {
                $q->whereRaw("UPPER(descricao) LIKE '%" . strtoupper($descricao) . "%'");
            })->get();


        if ($search->count() > 0) {
            return $search;
        }

        return response()->json(['msg' => 'Produto não Encontrado', 401]);
    }

    public function preco()
    {
        return $this->hasMany(Preco::class, 'produtos_id');
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class, 'produtos_id');
    }

    public function getThumbnailAttribute()
    {
        return 'https://diaadiaarquivos.blob.core.windows.net/' . $this->url_imagem . '?random_number=' . rand(0, 99);
        //return url($this->url_imagem) . '?random_number=' . rand(0, 99);
    }
}
