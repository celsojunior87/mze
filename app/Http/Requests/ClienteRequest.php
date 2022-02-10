<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use App\Rules\ValidarCpf;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use LaravelLegends\PtBrValidator\Rules\FormatoCpf;

class ClienteRequest extends FormRequest
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

            // 'cpf' => ['required', new ValidarCpf],
            // 'email' => ['required', Rule::unique('tb_clientes', 'email')->ignore($this->id)],
            // 'nome' => ['required'],
            // 'telefone' => ['required'],
            // 'password' => ['required']

        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é Obrigatorio',
            'email.required' => 'O E-mail é Obrigatório',
            'email.email' => 'Por favor, coloque o um e-mail valido',
            'email.unique' => ' O E-mail ja existe em nossa base de dados',
            'cpf.unique' => ' O CPF/CNPJ ja existe em nossa base de dados',
            'telefone.required' => ' O Telefone é Obrigatório',
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
