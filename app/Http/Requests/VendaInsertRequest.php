<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class VendaInsertRequest extends FormRequest
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
            'venda.vl_total' => 'required',
            'venda.vl_desconto' => 'required',
            'venda.avaliacao' => 'required',
            'venda.retirada' => 'required',
            'venda.status_id' => 'required',
            'venda.*.venda_itens.*.qt' => 'required',
            'venda.*.venda_itens.*.valor' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'venda.vl_total.required' => 'O valor total é Obrigatorio!',
            'venda.vl_desconto.required' => 'O valor do Desconto Obrigatorio!',
            'venda.avaliacao.required' => 'A Avaliação é Obrigatoria!',
            'venda.retirada.required' => 'A  Opção de Retirada é Obrigatoria!',
            'venda.status_id.required' => 'O status id  é Obrigatorio!',
            'venda_itens.qt.required' => 'Quantidade é obrigatorio',
            'venda.venda_itens.valor' . 'required' => 'O valor é obrigatorio'
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
