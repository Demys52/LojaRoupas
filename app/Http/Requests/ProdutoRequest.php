<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
          'nome.required'=>'Preencha o nome do produto',
          'nome.max'=>'Nome deve ter até 255 caracteres',
          'referencia.required'=>'Preencha a referencia do produto',
          'referencia.max'=>'Referencia não deve ter mais de 255 caracteres',
          'descricao.required'=>'Preencha a descricao do produto',
          'descricao.max'=>'Descricao não deve ter mais de 255 caracteres',
          'tipo.required'=>'Preencha a descricao do produto',
          'tipo.max'=>'Descricao não deve ter mais de 255 caracteres',
          'modelo.required'=>'Preencha o modelo do produto',
          'modelo.max'=>'Modelo não deve ter mais de 255 caracteres',
          'preco.required'=>'Informe o valor do produto',
          'images.*.required'=>'Carregue a imagem do produto',
          'P.required'=>'Preencha o estoque do produto, se nulo informe "0"',
          'P.numeric'=>'Verifique a quantidade informada no Estoque',
          'M.required'=>'Preencha o estoque do produto, se nulo informe "0"',
          'M.numeric'=>'Verifique a quantidade informada no Estoque',
          'G.required'=>'Preencha o estoque do produto, se nulo informe "0"',
          'G.numeric'=>'Verifique a quantidade informada no Estoque',
          'GG.required'=>'Preencha o estoque do produto, se nulo informe "0"',
          'GG.numeric'=>'Verifique a quantidade informada no Estoque'
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
            'nome'=>'required|max:255', 'referencia'=>'required|max:255', 'descricao'=>'required|max:255', 'tipo'=>'required|max:255',
            'modelo'=>'required|max:255', 'preco'=>'required', 'images.*'=>'required', 'P'=>'required|numeric', 'P'=>'required|numeric',
            'M'=>'required|numeric', 'G'=>'required|numeric', 'GG'=>'required|numeric'
        ];
    }
}
