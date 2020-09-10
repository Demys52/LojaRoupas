<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index()
    {
        $this->middleware('auth');
        
        $produtos = \App\Produto::paginate(10);
        return view('produto.produtos', compact('produtos'));
    }
    
    public function adicionar()
    {
        if(isset(auth()->user()->id))
        {
            return view('produto.adicionar');
        }
        else
        {
            return redirect()->route('welcome');
        }
    }
    
    public function salvar(\App\Http\Requests\ProdutoRequest $request)
    {
        if(isset(auth()->user()->id))
        {
            //dd(public_path());
            foreach($request->file('produto_imagens') as $file)
            {
                if(!$file->isValid())
                {
                    \Session::flash('flash_message',[
                                                     'msg'=>'Erro ao receber o arquivo ou formato inválido.',
                                                     'class'=>'alert alert-danger'
                                                     ]);
                    return redirect()->route('produto.produtos');
                }
                elseif(!$file->extension())
                {
                    \Session::flash('flash_message',[
                                                     'msg'=>'Formato inválido.',
                                                     'class'=>'alert alert-danger'
                                                     ]);
                    return redirect()->route('produto.produtos');
                }
            }
            //dd($request);
            //$extension = $request->produto_imagens->extension();
            //if(strstr( '.jpg;.jpeg;.png', $extension ))
            $produto = new \App\Produto;
            //$produto->cadastrado = auth()->user()->id;
            $produto->nome = $request->input("nome");
            $produto->referencia = $request->input("referencia");
            $produto->descricao = $request->input("descricao");
            $produto->tipo = $request->input("tipo");
            $produto->modelo = $request->input("modelo");
            $produto->preco = (float)str_replace(',', '.', $request->input("preco"));
            $produto->save();
            
            foreach($request->produto_imagens as $imagem)
            {
                //$path = $imagem->store('images');     =====> COMANDO ALTERADO PARA FUNCIONAR COM O infinityfree QUE NÃO POSSUI SUPORTE AO LARAVEL
                $extension = $imagem->extension();
                $novoNome = uniqid ( uniqid(date('Ymd')) ) . '.' . $extension;
                $destino = 'images/' . $novoNome;
                @move_uploaded_file( $imagem, $destino );
                $foto = new \App\ProdutosImagens;
                $foto->produto_id = $produto->id;
                $foto->imagem = $destino;
                $foto->save();
            }
            $tamanho = ["P","M","G","GG"];
            for($x=0; $x < count($tamanho); $x++)
            {
                $estoque = new \App\ProdutosTamanhos;
                $estoque->produto_id = $produto->id;
                $estoque->tamanho = $tamanho[$x];
                $estoque->estoque = $request->input($tamanho[$x]);
                $estoque->save();
            }
            \Session::flash('flash_message',[
                                             'msg'=>'Produto cadastrado com sucesso!',
                                             'class'=>'alert alert-success'
                                             ]);
            return redirect()->route('produto.produtos');
        }
        else
        {
            return redirect()->route('welcome');
        }
        
    }
    
    public function editar($id)
    {
        if(isset(auth()->user()->id))
        {
            $produto = \App\Produto::find($id);
            if($produto)
            {
                return view('produto.editar', compact('produto'));
            }
            else
            {
                \Session::flash('flash_message',[
                                             'msg'=>'Produto não encontrado!',
                                             'class'=>'alert alert-danger'
                                             ]);
                return redirect()->route('produto.produtos');
            }
        }
        else
        {
            return redirect()->route('welcome');
        }
        
    }
    
    public function atualizar (Request $request, $id)
    {
        $produto = \App\Produto::find($id);
        if($produto)
        {
            $produto->nome = $request->nome;
            $produto->referencia = $request->referencia;
            $produto->descricao = $request->descricao;
            $produto->tipo = $request->tipo;
            $produto->modelo = $request->modelo;
            $produto->preco = (float)str_replace(',', '.', $request->preco);
            $produto->save();
            \Session::flash('flash_message',[
                                         'msg'=>'Produto atualizado com sucesso',
                                         'class'=>'alert alert-success'
                                         ]);
            return view('produto.editar', compact('produto'));
        }
        else
        {
            \Session::flash('flash_message',[
                                         'msg'=>'Produto não encontrado!',
                                         'class'=>'alert alert-danger'
                                         ]);
            return view('produto.adicionar');
        }
    }
    public function tamanho_estoque(Request $request, $id)
    {
        if(isset(auth()->user()->id))
        {  
            $produto = \App\Produto::find($id);
            if($produto)
            {
                if($request->has('p'))
                {
                    $estoque = new \App\ProdutosTamanhos;
                    $request->input('p');
                }
            }
            else
            {
                \Session::flash('flash_message',[
                                             'msg'=>'Produto não encontrado!',
                                             'class'=>'alert alert-danger'
                                             ]);
                return view('produto.adicionar');
            }
        }
        else
        {
            return redirect()->route('welcome');
        }
    }
    
    public function tshirt()
    {
        $produtos = \App\Produto::where(['tipo'=> 'camiseta', 'modelo'=>'t-shirt'])->paginate(8);
        return view('produto.index', compact('produtos'));
    }
    
}