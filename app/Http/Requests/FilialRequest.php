<?php

namespace App\Http\Requests;

use App\Rules\ValidarCpf;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class FilialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'descricao' => 'required',
            'endereco' => 'required',
            'cnpj' => ['required', new ValidarCpf, Rule::unique('tb_filiais', 'cnpj')->ignore($this->id)],
            'url_imagem' => 'required',
            'endereco.cep' => 'required',
            'endereco.endereco' => 'required',
            'endereco.numero' => 'required',
            'endereco.uf' => 'required',
            'endereco.bairro' => 'required',
            'endereco.cidade' => 'required',
            'endereco.latitude' => 'required',
            'endereco.longitude' => 'required',
            'endereco.descricao' => 'required',
            'endereco.regioes_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'Nome é Obrigatorio!',
            'url_imagem.required' => 'A Foto da Filial é Obrigatoria!',
            'cnpj.required' => 'Cnpj é Obrigatorio',
            'cnpj.unique' => 'Cnpj já cadastrado',
            'endereco.cep.required' => 'O CEP do endereço é Obrigatório',
            'endereco.endereco.required' => 'O Logradouro do endereço é Obrigatório',
            'endereco.numero.required' => 'O Número do endereço é Obrigatório',
            'endereco.uf.required' => 'O Estado do endereço é Obrigatória',
            'endereco.bairro.required' => 'O Bairro do endereço é Obrigatória',
            'endereco.cidade.required' => 'A cidade do endereço é Obrigatória',
            'endereco.latitude.required' => 'A latitude do endereço é Obrigatória',
            'endereco.longitude.required' => 'A longitude do endereço é Obrigatória',
            'endereco.descricao.required' => 'A descrição do endereço é Obrigatória',
            'endereco.regioes_id.required' => 'A Região do endereço é Obrigatória'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $keys = $errors->keys();
        $all = $errors->all();

        $return = [];
        foreach ($keys as $index => $key) {
            $return[$key] = $all[$index];
        }

        throw new HttpResponseException(response()->json([
            'validators' => $return
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
