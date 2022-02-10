<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ProdutoRequest extends FormRequest
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
        $rules = [
            'titulo' => 'required',
            'descricao' => 'required',
            'qt_caixa' => 'required',
            'descricao_detalhada' => 'required',
            'ean' => 'required',
            'unidade' => 'required',
            'url_imagem' => 'required',
            'ncm' => 'required',
        ];

        if (request()->id) {
            $rules['url_imagem'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'titulo.required' => 'O Titulo é Obrigatorio!',
            'descricao.required' => 'A Descrição é Obrigatoria!',
            'ean.required' => 'Codigo de Barras é Obrigatoria!',
            'descricao_detalhada.required' => 'A Descrição é Obrigatoria!',
            'ncm.required' => 'O Ncm é Obrigatorio!',
            'qt_caixa.required' => 'A Quantidade é Obrigatoria!',
            'url_imagem.required' => 'A imagem é Obrigatoria!'
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
