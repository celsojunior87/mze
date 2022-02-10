<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class EnderecoRequest extends FormRequest
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

            'cep'=> 'required',
            'descricao'=> 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'uf' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'tipo'=> 'required',
            'latitude'=> 'required',
            'longitude'=> 'required'

        ];
    }


    public function messages()
    {
        return [
            'cep.required' => 'O  cep é obrigatorio',
            'descricao.required' => 'A descrição  é obrigatoria',
            'endereco.required' => 'O endereço é obrigatorio',
            'uf.required' => 'A Uf obrigatorio',
            'bairro.required' => 'O Bairro é obrigatorio!',
            'cidade.required' => 'A cidade é obrigatorio!',
            'tipo.required' => 'O Tipo é obrigatorio!',
            'latitude.required' => 'A latitude é obrigatorio!',
            'longitude.required' => 'A longitude é obrigatorio!',
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

        throw new HttpResponseException(response()->json(['validators' => $return
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
