<?php

namespace App\Http\Requests;

use App\Rules\ValidarCpf;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ContaBancariaRequest extends FormRequest
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

            'nome' => 'required',
            'titular' => 'required',
            'agencia' => 'required',
            'num_conta' => 'required',
            'cpf' => ['required', new ValidarCpf],
            'socios_id' => 'required',
            'instituicoes_financeiras_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O Nome é Obrigatorio!',
            'titular.required' => 'O Titular é Obrigatorio!',
            'agencia.required' => 'A Agência é Obrigatoria!',
            'cpf.required' => 'O CPF é Obrigatorio!',
            'instituicoes_financeiras_id.required' => 'A Instituição Financeira é Obrigatoria!',
            'socios_id.required' => 'O Sócio é Obrigatorio!',
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
