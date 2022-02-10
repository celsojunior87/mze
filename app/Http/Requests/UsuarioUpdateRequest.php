<?php

namespace App\Http\Requests;

use App\Rules\ValidarCpf;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UsuarioUpdateRequest extends FormRequest
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
        'nome' => 'required'
    ];
    if (request()->cpf) {
        $rules['cpf'] = ['required',new ValidarCpf];

    }
    return $rules;
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
