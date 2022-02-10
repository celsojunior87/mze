<?php

namespace App\Repositories\Painel;

use App\Interfaces\Painel\SocioPainelInterface;
use App\Models\Endereco;
use App\Models\Filial;
use App\Models\Socio;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use App\Traits\ImageHandler;
use App\Http\Requests\SocioPainelRequest;
use Illuminate\Http\Request;

class SocioPainelRepository implements SocioPainelInterface
{
    // Use ResponseAPI Trait in this repository
    use Response, ImageHandler;

    public function __construct(Socio $socio)
    {
        $this->model = $socio;
    }

    public function getAll()
    {
        try {
            $socio = Socio::with('endereco', 'filiais')->get();
            return $this->success("Lista de Sócios", $socio);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function findById($id)
    {
        try {
            $socio = Socio::with('filiais', 'endereco', 'filiais.endereco', 'contasBancarias', 'contasBancarias.instituicaoFinanceira')
                ->find($id);
            if (!$socio) return $this->error("Não Possui Sócios $id", 404);
            return $this->success("Detalhes dos Sócios", $socio);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function saveOrUpdate(SocioPainelRequest $request, $id = null)
    {

        DB::beginTransaction();
        try {
            //Cadastra Sócio
            $socio = Socio::with('endereco')->findOrNew($id);

            $socio['nome'] = $request->nome;
            $socio['email'] = $request->email;
            $socio['cpf'] = $request->cpf;
            $socio['telefone'] = $request->telefone;
            $socio['raio_entrega'] = $request->raio_entrega;
            $socio['situacao'] = $request->situacao == 'true'  ? 1 : 0;
            $socio['password'] = bcrypt($request->password);

            //upload de fotos
            $socio['url_foto'] = $this->createUrlImagem($request->url_foto, "Foto_" . $socio['cpf'], 'socios');
            $socio['url_documento_frente'] = $this->createUrlImagem($request->url_documento_frente, "Documento_Frente_" . $socio['cpf'], 'socios');
            $socio['url_documento_verso'] = $this->createUrlImagem($request->url_documento_verso, "Documento_Verso_" . $socio['cpf'], 'socios');

            if (!$socio['url_foto']) {
                return response()->json(['message' => 'A Imagem do Sócio não é válida. Verifique o arquivo enviado.'], 500);
            }

            if (!$socio['url_documento_frente']) {
                return response()->json(['message' => 'A Imagem da Frente do Documento não é válida. Verifique o arquivo enviado.'], 500);
            }

            if (!$socio['url_documento_verso']) {
                return response()->json(['message' => 'A Imagem do Verso do Documento não é válida. Verifique o arquivo enviado.'], 500);
            }

            //Cria endereco
            $endereco = $socio->endereco ?? new Endereco();
            $endereco->cep = $request->endereco['cep'];
            $endereco->endereco = $request->endereco['endereco'];
            $endereco->numero = $request->endereco['numero'];
            $endereco->uf = $request->endereco['uf'];
            $endereco->bairro = $request->endereco['bairro'];
            $endereco->cidade = $request->endereco['cidade'];
            $endereco->complemento = $request->endereco['complemento'];
            $endereco->tipo = 'CASA';
            $endereco->latitude = $request->endereco['latitude'];
            $endereco->longitude = $request->endereco['longitude'];
            $endereco->descricao = $request->endereco['descricao'];
            $endereco->regioes_id = $request->endereco['regioes_id'];
            $endereco->save();

            $socio->enderecos_id = $endereco->id;
            $socio->save();

            DB::commit();

            if (empty($id)) {
                return $this->success("Sócio Criado com sucesso", $socio, 200);
            }

            return $this->success("Sócio atualizado com sucesso", $socio, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Erro ao criar ou atualizar sócio.' . $e->getMessage(), 422);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $socio = Socio::find($id);

            // Check the socios
            if (!$socio) return $this->error("Não Existe Sócios $id", 404);

            // Deleta o socios
            $socio->delete();
            DB::commit();
            return $this->success("Sócios deletado com Sucesso", $socio);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 404);
        }
    }


    public function search($request)
    {

        try {
            if ($request->input('regioes_id')) {
                $retorno =  Endereco::all();
            }
            return $this->success("Detalhes dos Endereços", $retorno);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function toDataTable(Request $request)
    {
        $sort = $request->sort ?? 'nome';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';
        $nome = $request->input('nome');
        $cpf = $request->input('cpf');
        $email = $request->input('email');

        $produtos = Socio::when($email, function ($q) use ($email) {
            $q->whereRaw("UPPER(email) LIKE '%" . strtoupper($email) . "%'");
        })
            ->when($cpf, function ($q) use ($cpf) {
                $q->whereRaw("cpf LIKE '" . $cpf . "%'");
            })
            ->when($nome, function ($q) use ($nome) {
                $q->whereRaw("UPPER(nome) LIKE '%" . strtoupper($nome) . "%'");
            })
            ->orderBy($sort, $dir)
            ->paginate($items);

        return $produtos;
    }
}
