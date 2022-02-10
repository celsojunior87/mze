<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class PromocaoRequest extends FormRequest
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

    public function rules()
    {
        return [

        'descricao' => 'required|min:3',
        'url_imagem' => 'required',
        'dt_inicial' => [
            'required',
        ],
            'dt_final' =>[
                'required',
                'after_or_equal:dt_inicial'
            ]

         ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'Descrição é Obrigatorio!',
            'descricao.min' => 'A descrição deve ter pelo menos 3 caracteres!',
            'url_imagem.required' => 'A imagem é Obrigatoria!',
            'dt_inicial.required' => ' A Data Inicial é Obrigatoria',
            'dt_final.required' => ' A Data Final é Obrigatoria',
            'dt_final.after_or_equal' => ' A Data Final não pode ser menor que a data inicial',
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
