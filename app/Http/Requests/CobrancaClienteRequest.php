<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class CobrancaClienteRequest extends FormRequest
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
            'descricao' => 'required|min:3',
        ];

        if (!request()->id) {

            $rules['numero_cartao'] = 'required|min:16';
            $rules['cgc'] = 'required|min:11';
            $rules['dt_vencimento'] = 'required';
            $rules['titular'] = 'required';
            $rules['tipos_cobrancas_id'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'descricao.required' => 'Descrição é Obrigatorio!',
            'numero_cartao.required' => 'O numero do Cartão é Obrigatorio!',
            'dt_vencimento.required' => 'A data de vencimento é Obrigatorio!',
            'descricao.min' => 'A descrição deve ter pelo menos 3 caracteres!',
            'titular' => 'O Titular do cartão é obrigatorio!',
            'cgc.required' => 'O cgc é Obrigatorio',
            'tipo_cobrancas_id.required' => 'O tipo de cobranca id Obrigatorio',
            'numero_cartao.min' => 'A descrição deve ter pelo menos 16 caracteres!',
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
