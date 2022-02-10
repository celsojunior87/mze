<?php

namespace App\Repositories\Socio;

use App\Interfaces\Socio\SocioInterface;
use App\Models\Endereco;
use App\Models\Filial;
use App\Models\Socio;
use Illuminate\Support\Facades\DB;
use App\Traits\Response;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SocioRequest;
use App\Http\Requests\VendaRequest;
use App\Models\ContaBancaria;
use App\Notifications\SocioEmailNotification;
use Illuminate\Support\Facades\Auth;
use App\Traits\BaseUrlReturn;

class SocioRepository implements SocioInterface
{
    // Use ResponseAPI Trait in this repository
    use Response, ImageHandler, BaseUrlReturn;

    public function __construct(Socio $socio)
    {
        $this->model = $socio;
    }

    public function registration($request)
    {
        DB::beginTransaction();
        try {
            if (isset($request->cpf)) {
                if ($this->model->existByCPF($request->cpf)) {
                    $validator = Validator::make([], []);
                    $validator->errors()->add('cpf', 'CPF existente na base de Dados');
                    return response()->json($validator->getMessageBag()->all(), 202);
                }
            }

            //Cadastra Sócio
            $socio['nome'] = $request->nome;
            $socio['email'] = $request->email;
            $socio['cpf'] = $request->cpf;
            $socio['telefone'] = $request->telefone;
            $socio['password'] = bcrypt($request->password);

            //upload de fotos
            $socio['url_foto'] = $this->createUrlImagem($request->url_foto, "Foto_" . $socio['cpf'], 'socios');
            $socio['url_documento_frente'] = $this->createUrlImagem($request->url_documento_frente, "Documento_Frente_" . $socio['cpf'], 'socios');
            $socio['url_documento_verso'] = $this->createUrlImagem($request->url_documento_verso, "Documento_Verso_" . $socio['cpf'], 'socios');

            if ($socio['url_foto'] == false or $socio['url_documento_frente'] == false or $socio['url_documento_verso'] == false) {
                return response()->json(['message' => 'A imagem não é válida. Verifique o arquivo enviado.'], 401);
            }
            $socio = Socio::create($socio);

            //Cria endereco

            $endereco = $this->createEndereco($request->filial['endereco']);
            $endereco->save();

            // Cria Filial
            $filial = $this->createFilial($request->filial, $socio->id, $endereco->id, $endereco->endereco);

            if ($filial->url_imagem == false) {
                return response()->json(['message' => 'A imagem não é válida. Verifique o arquivo enviado.'], 401);
            }
            $filial->save();
            $resArr = [];
            $resArr['token'] = $socio->createToken('api-application')->accessToken;
            $resArr['nome'] = $socio->nome;
            $resArr['cpf'] = $socio->cpf;
            $resArr['email'] = $socio->email;
            $resArr['telefone'] = $socio->telefone;
            $resArr['raio_entrega'] = $socio->raio_entrega;
            $resArr['instituicoes_financeiras_id'] = $socio->instituicoes_financeiras_id;
            $resArr['url_foto'] = $socio->url_foto;
            $resArr['url_documento_frente'] = $socio->url_documento_frente;
            $resArr['enderecos_id'] = $endereco->id;
            $resArr['filiais_id'] = $filial->id;

            $socio->notify(new SocioEmailNotification($socio));

            DB::commit();
            return $this->success("Sócio Criado com sucesso", $resArr, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error("Erro ao cadastrar sócio::" . $e->getMessage(), 500);
        }
    }

    public function createEndereco($enderecos)
    {

        $endereco = new Endereco();
        $endereco->cep = $enderecos['cep'];
        $endereco->endereco = $enderecos['endereco'];
        $endereco->numero = $enderecos['numero'];
        $endereco->uf = $enderecos['uf'];
        $endereco->bairro = $enderecos['bairro'];
        $endereco->cidade = $enderecos['cidade'];
        $endereco->complemento = $enderecos['complemento'];
        $endereco->tipo = $enderecos['tipo'];
        $endereco->latitude = $enderecos['latitude'];
        $endereco->longitude = $enderecos['longitude'];
        $endereco->descricao = $enderecos['descricao'];
        $regioes_id = DB::select("select public.fnc_consulta_regiao('" . $enderecos['latitude'] . "', '" . $enderecos['longitude'] . "') as regioes_id");
        $endereco->regioes_id = $regioes_id[0]->regioes_id;

        return $endereco;
    }

    public function createFilial($filiais, $socioId, $enderecoId, $endereco)
    {
        $filial = new Filial();
        $filial->descricao = $filiais['descricao'];
        $filial->cnpj = $filiais['cnpj'];
        $filial->socios_id = $socioId;
        //alterar a mix_id quando a função estiver pronta
        $filial->mix_id = 1;
        $filial->tipo_filial = $filiais['tipo_filial'];
        $filial->token_filial = md5($filiais['cnpj'] . $endereco);
        $filial->url_imagem = $this->createUrlImagem($filiais['url_imagem'], "Imagem_Filial_" . $filial->cnpj, 'filiais');
        $filial->enderecos_id = $enderecoId;

        return $filial;
    }

    public function getAll()
    {
        try {
            $socio = Socio::with('endereco', 'filiais')->get();
            return $this->success("Lista de Sócios", $socio);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
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
            return $this->error($e->getMessage(), 500);
        }
    }

    public function saveOrUpdate(SocioRequest $request, $id = null)
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

            if ($socio['url_foto'] == false or $socio['url_documento_frente'] == false or $socio['url_documento_verso'] == false) {
                return response()->json(['message' => 'A imagem não é válida. Verifique o arquivo enviado.'], 401);
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
            return $this->error($e->getMessage(), 500);
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
            return $this->error($e->getMessage(), 401);
        }
    }

    public function toDataTable($request)
    {
        $sort = $request->sort ?? 'nome';
        $items = $request->input('per_page') ?? 10;
        $dir = $request->input('dir') ?? 'ASC';

        $produtos = Socio::when($request->input('search'), function ($q) use ($request) {
            $column = $request->input('search');
            $q->whereRaw("UPPER(nome) LIKE '%" . strtoupper($column) . "%'");
            $q->orWhereRaw("UPPER(email) LIKE '%" . strtoupper($column) . "%'");
        })
            ->orderBy($sort, $dir)
            ->paginate($items);

        return $produtos;
    }

    //Atualiza dos dados cadastrais,filial e salva os dados bancarios do sócio
    public function updateDadosSocio($request)
    {
        $user = Auth::user();
        if (!$user) {
            return $this->error("Favor fazer o login", 401);
        }
        $cpf = $user->cpf;
        $idSocio = $user->id;


        DB::beginTransaction();
        try {
            //Verifica se dados bancarios existe

            if ($request->contas_bancarias) {
                $contasBancarias = ContaBancaria::where('socios_id', $idSocio)->first();
                if ($contasBancarias == null) {
                    if (
                        empty($request->contas_bancarias['nome']) ||
                        empty($request->contas_bancarias['titular']) ||
                        empty($request->contas_bancarias['agencia']) ||
                        empty($request->contas_bancarias['num_conta']) ||
                        empty($request->contas_bancarias['num_conta']) ||
                        empty($request->contas_bancarias['cpf']) ||
                        empty($request->contas_bancarias['instituicoes_financeiras_id'])
                    ) {
                        return $this->error('Não é possível cadastrar a conta. Preencha todos os campos.', 400);
                    }
                    $contas_bancarias = new ContaBancaria();

                    $contas_bancarias->nome = $request->contas_bancarias['nome'];
                    $contas_bancarias->titular = $request->contas_bancarias['titular'];
                    $contas_bancarias->agencia = $request->contas_bancarias['agencia'];
                    $contas_bancarias->num_conta = $request->contas_bancarias['num_conta'];
                    $contas_bancarias->cpf = $request->contas_bancarias['cpf'];
                    $contas_bancarias->instituicoes_financeiras_id = $request->contas_bancarias['instituicoes_financeiras_id'];
                    $contas_bancarias->socios_id = $idSocio;
                    $contas_bancarias->save();
                } else {
                    ContaBancaria::find($contasBancarias['id'])->update($request->contas_bancarias);
                }
            }

            $dados = $request->all();
            if ($request->url_foto) {
                $dados['url_foto'] =  $this->createUrlImagem($request->url_foto, "Foto_" . $cpf, 'socios');
            }
            $socio = Socio::find($idSocio)->update($dados);

            if ($request->filial) {
                $filial = $this->updateFilial($request, $cpf);
                if (!$filial) {
                    DB::rollBack();
                    return $this->error('Não é possível atualizar os dados da filial, erro na imagem enviada.', 400);
                }
                Filial::where('socios_id', $idSocio)->update($filial);
            }

            DB::commit();

            $socio = Socio::where('id', $idSocio)->first();
            $filial = Filial::where('socios_id', $idSocio)->first();
            $endereco = Endereco::where('id', $filial->enderecos_id)->first();
            $dados_bancarios = ContaBancaria::where('socios_id', $idSocio)->first();

            $socio->url_foto = $this->getUrl($socio->url_foto);
            $socio->url_documento_frente = $this->getUrl($socio->url_documento_frente);
            $socio->url_documento_verso = $this->getUrl($socio->url_documento_verso);
            $filial->url_imagem = $this->getUrl($filial->url_imagem);

            $retorno = $socio;
            $retorno['filial'] = $filial;
            $retorno['endereco'] = $endereco;
            $retorno['dados_bancarios'] = $dados_bancarios;
            // dd($retorno);

            return $this->success("Dados do sócio atualizados com sucesso!", $retorno);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 401);
        }
    }
    //Atualiza a filial

    public function updateFilial($request, $cpf)
    {
        $arrDados = $request['filial'];

        if ($request['filial']['url_imagem']) {
            $arrDados['url_imagem'] =  $this->createUrlImagem($request['filial']['url_imagem'], "Foto_" . $cpf, 'filiais');
        }


        return $arrDados;
    }

    public function saveContasBancarias($idSocio, $request)
    {

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'titular' => 'required|max:255',
            'agencia' => 'required',
            'num_conta' => 'required',
            'cpf' => 'required',
            'socios_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 500);
        }

        $contasBancarias = ContaBancaria::create($request->toArray());
        return response($contasBancarias, 200);
    }
}
