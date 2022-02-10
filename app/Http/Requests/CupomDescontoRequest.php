<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CupomDescontoRequest extends FormRequest
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

            'codigo_cupom'=> 'required',
            'dt_inicial' => 'required',
            'dt_final' =>[
                'required',
                'after_or_equal:dt_inicial'
            ],
            'perc_desc' => 'required',
            'vl_desc' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'codigo_cupom.required' => 'Codigo do Cupom é Obrigatoio!',
            'dt_inicial.required' => 'A Data Inicial é Obrigatoio!',
            'dt_final.required' => ' A Data Final é Obrigatoria',
            'dt_final.after_or_equal' => ' A Data Final não pode ser menor que a data inicial',
            'perc_desc.required' => 'A Porcentagem de Desconto é Obrigatório!',
            'vl_desc.required' => ' O valor de Desconto é Obrigatório!',
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
