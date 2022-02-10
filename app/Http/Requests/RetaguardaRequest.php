<?php

namespace App\Http\Requests;

use App\Rules\ValidarCpf;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class RetaguardaRequest extends FormRequest
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
            'cpf' => ['required', new ValidarCpf, Rule::unique('tb_administradores', 'cpf')->ignore($this->id)],
            'email' => ['required', 'email', Rule::unique('tb_administradores', 'email')->ignore($this->id)],
            'nome' => ['required'],
            'password' => 'sometimes|required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é Obrigatorio',
            'email.required' => 'O E-mail é Obrigatório',
            'email.email' => 'Por favor, coloque o um e-mail valido',
            'email.unique' => ' O E-mail já existe em nossa base de dados',
            'cpf.unique' => ' O CPF já existe em nossa base de dados'
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
