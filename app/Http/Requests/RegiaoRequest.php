<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class RegiaoRequest extends FormRequest
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
            'raio_entrega' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'A Descrição é Obrigatorio!',
            'raio_entrega.required' => 'O Raio de Entrega é Obrigatorio!',
            'latitude.required' => ' A Latitude é Obrigatorio',
            'longitude.required' => ' A Longitude é Obrigatorio',
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
