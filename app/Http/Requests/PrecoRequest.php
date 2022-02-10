<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class PrecoRequest extends FormRequest
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
            'preco' => 'required',
            'perc_comisao' => 'required',
            'valor_comisao' => 'required',
            'regioes_id' => 'required',
            'produtos_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'preco.required' => 'O Preço é obrigatorio!',
            'perc_comissao.required' => 'A Porcentagem da Comissão é obrigatoria!',
            'valor_comissao.required' => 'O Valor da comissão é obrigatoria!',
            'regioes_id.required' => 'O ID da região é obrigatorio!',
            'produtos_id.required' => 'O ID do produto é obrigatorio!'
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
