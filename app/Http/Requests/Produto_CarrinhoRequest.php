<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Produto_CarrinhoRequest extends FormRequest
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

    public function messages()
    {
        return
        [
          'quantidade.required'=>'Informe a quantidade',
          'quantidade.numeric'=>'Verifique a quantidade informada',
          'quantidade.between'=>'Quantidade deve ser maior que "0"',
          'tamanho.required'=>'Selecione o tamanho'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantidade'=>'required|numeric|min:1', 'tamanho'=>'required'
        ];
    }
}
