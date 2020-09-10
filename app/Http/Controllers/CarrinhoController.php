<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public static function dataHora()
    {
        return date('Y/m/d H:i:s');
    }
    
    public function index()
    {
        if(auth()->check())
        {   // verifica se usuario criou um carrinho enquanto estava deslogado
            if(!session_start()){session_start();}
            if(isset($_SESSION['pedido']))
            {   //verifica se o carrinho está em branco
                $carrinho = $_SESSION['pedido'];
                if($carrinho)
                {
                    //dd($carrinho);
                    $pedido = new \App\Pedido;
                    $pedido->usuario_id = auth()->user()->id;
                    $pedido->status = 'R';
                    foreach($carrinho as $produto)
                    {
                        $total[] = $produto->valor; 
                    }
                    $pedido->valor = array_sum($total);
                    $pedido->save();
                    //itens
                    if($pedido->id)
                    {
                        foreach($carrinho as $produto)
                        {
                            $itens = new \App\PedidoItens;
                            $prod = \App\Produto::find($produto->pedido_itens->produto_id);
                            //dd($prod);
                            $itens->pedido_id = $pedido->id;
                            $itens->produto_id = $produto->pedido_itens->produto_id;
                            $itens->quantidade = $produto->pedido_itens->quantidade;
                            $itens->valor_unidade = $prod->preco;
                            $itens->valor_desconto = $produto->pedido_itens->valor_desconto; // verificar se no começo se existe desconto
                            $itens->valor_total = $produto->pedido_itens->quantidade * ($prod->preco - $produto->pedido_itens->valor_desconto);
                            $itens->tamanho_id = $produto->pedido_itens->tamanho_id;
                            $itens->save();
                        }
                    }
                }
            }
            $login = auth()->user()->id;
            $carrinho = \App\Pedido::where(['status'=> 'R', 'usuario_id'=> $login])->get();
            if(!$carrinho->isEmpty())
            {
                session_destroy();
                $carrinho = last($carrinho);
                if(count($carrinho[0]->pedido_itens) == 0)
                {
                    $carrinho = null;
                }
                return view('carrinho.index', compact('carrinho'));
            }
            else
            {
                $carrinho = null;
                return view('carrinho.index', compact('carrinho'));
            }
        }
        else
        {
            if(!session_start()){session_start();}
            if(isset($_SESSION['pedido']))
            {
                $carrinho = $_SESSION['pedido'];
                return view('carrinho.index', compact('carrinho'));
            }
            else
            {
                $carrinho = null;
                return view('carrinho.index', compact('carrinho'));
            }
            //return view('carrinho.index');
        }
    }
    
    public function produto($id)
    {
        //$ofertas = \App\Produto::where(['tipo'=> 'camiseta'])->groupBy('nome')->max('created_at');
        $produto = \App\Produto::find($id);
        
        $ofertas = \App\Produto::where(['tipo'=> $produto->tipo, 'modelo'=> $produto->modelo])->orderBy('created_at', 'desc')->get();
        //$ofertas = $produtos->groupBy('modelo');
        //dd($ofertas);
        return view('carrinho.produto', compact('produto', 'ofertas'));
    }
    
    public function adicionar(\App\Http\Requests\Produto_CarrinhoRequest $request, $id)
    {/*
        if(isset($request->input("desconto")))
        {
            $desconto = $request->input("desconto");
        }
        else
        {*/
            $desconto = 0;
        //}
        $produtos = \App\Produto::find($id);
        $estoque = \App\ProdutosTamanhos::find($request->input("tamanho"));
        if($estoque->estoque < $request->input("quantidade"))
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Quantidade maior que a de estoque, por favor entre em contato com (85)9.9728-5105',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('carrinho.produto', $id);
        }
        else
        {
            if(auth()->check())
            {
                $login = auth()->user()->id;
                $carrinho = \App\Pedido::where(['status'=> 'R', 'usuario_id'=>$login])->get();
                if(count($carrinho) > 0)
                {
                    //dd($carrinho);
                    //$produtos = \App\Produto::find($id);
                    $pedido = \App\Pedido::find($carrinho[0]->id);
                    $valor_atualizado = $carrinho[0]->valor + ($request->input("quantidade") * ($produtos->preco - $desconto));
                    $pedido->valor = $valor_atualizado;
                    $pedido->save();
                    $itens = new \App\PedidoItens;
                    $itens->pedido_id = $carrinho[0]->id;
                    $itens->produto_id = $produtos->id;
                    $itens->quantidade = $request->input("quantidade");
                    $itens->valor_unidade = $produtos->preco - $desconto;
                    $itens->valor_desconto = $desconto;
                    $itens->valor_total = $request->input("quantidade") * ($produtos->preco - $desconto);
                    $itens->tamanho_id = $request->input("tamanho");
                    $itens->save();
                }
                else
                {
                    //$produtos = \App\Produto::find($id);
                    $pedido = new \App\Pedido;
                    $pedido->usuario_id = $login;
                    $pedido->valor = $request->input("quantidade") * ($produtos->preco - $desconto);
                    $pedido->status = 'R';
                    $pedido->save();
                    $itens = new \App\PedidoItens;
                    $itens->pedido_id = $pedido->id;
                    $itens->produto_id = $produtos->id;
                    $itens->quantidade = $request->input("quantidade");
                    $itens->valor_unidade = $produtos->preco - $desconto;
                    $itens->valor_desconto = $desconto;
                    $itens->valor_total = $request->input("quantidade") * ($produtos->preco - $desconto);
                    $itens->tamanho_id = $request->input("tamanho");
                    $itens->save();
                }
            }
            else
            {
                if(!session_start()){session_start();}
                $request->input("quantidade");
                $produtos = \App\Produto::find($id);
                //dd($produtos->preco);
                $pedido = new \App\Pedido;
                $pedido->usuario_id = 1;
                $pedido->valor = $request->input("quantidade") * ($produtos->preco - $desconto);
                $pedido->status = 'R';
                //$pedido->usuario_id = 1;
                //$pedido->pedido_itens->pedido_id pegar informação na hora de salvar
                $pedido->pedido_itens->produto_id = $produtos->id;
                $pedido->pedido_itens->quantidade = $request->input("quantidade");
                $pedido->pedido_itens->valor_unidade = $produtos->preco - $desconto;
                $pedido->pedido_itens->valor_desconto = $desconto;
                $pedido->pedido_itens->total = $request->input("quantidade") * ($produtos->preco - $desconto);
                $pedido->pedido_itens->tamanho_id = $request->input("tamanho");
                
                $pedido->produto = $produtos;
                $pedido->produto_tamanho = $pedido->tamanho_id($request->input("tamanho"));
                $_SESSION['pedido'][] = $pedido;
                //dd($pedido);
            }
        }
        
        
        return redirect()->route('carrinho.index');
    }
        
    public function remover(Request $request)
    {
        if(auth()->check())
        {
            if(isset($request->produto))
            {
                $login = auth()->user()->id;
                $iten = \App\PedidoItens::find($request->produto);
                $carrinho = \App\Pedido::find($iten->pedido_id);
                if($carrinho->status == 'R' && $carrinho->usuario_id == $login)
                {
                    $iten->delete();
                    $total = 0;
                    foreach($carrinho->pedido_itens as $valor)
                    {
                        $total += $valor->valor_total;
                    }
                    //$total = array_sum(array_column($carrinho->pedido_itens,'valor_total'));
                    $carrinho->valor = $total;
                    $carrinho->save();
                    \Session::flash('flash_message',[
                                                    'msg'=>'Produto removido!',
                                                    'class'=>'alert alert-success'
                                                    ]);
                    return response()->json(['success'=> true]);
                }
                else
                {
                    return response()->json(['success'=> false]);
                }
            }
            else
            {
                return response()->json(['success'=> false]);
            }
            
        }
        else
        {
            if(!session_start()){session_start();}
            if(isset($_SESSION['pedido']))
            {
                if(isset($request->produto))
                {
                    $produto = $request->produto;
                    unset($_SESSION['pedido'][$produto]);
                    sort($_SESSION['pedido']);
                    \Session::flash('flash_message',[
                                                    'msg'=>'Produto removido!',
                                                    'class'=>'alert alert-success'
                                                    ]);
                    return response()->json(['success'=> true]);
                }
                else
                {
                    return response()->json(['success'=> false]);
                }
            }
            else
            {
                
                return response()->json(['success'=>'false2.']);
            }
            //return view('carrinho.index');
        }
    }
    
    public function quantidade(Request $request)
    {
        if(auth()->check())
        {
            $login = auth()->user()->id;
            $carrinho = \App\Pedido::where(['status'=> 'R', 'user'=>$login]);
            
            if(isset($request->produto) && isset($request->quantidade) && $request->quantidade > 0)
            {
                $iten = \App\PedidoItens::find($request->produto);
                $carrinho = \App\Pedido::find($iten->pedido_id);
                $quantidade = intval($request->quantidade);
                $produto = intval($request->produto);
                if($carrinho->status == 'R' && $carrinho->usuario_id == $login)
                {
                    $iten->quantidade = $quantidade;
                    $iten->valor_total = ($quantidade * $iten->valor_unidade);
                    $iten->save();
                    $total = 0;
                    foreach($carrinho->pedido_itens as $valor)
                    {
                        $total += $valor->valor_total;
                    }
                    //$total = array_sum(array_column($carrinho->pedido_itens,'valor_total'));
                    $carrinho->valor = $total;
                    $carrinho->save();
                    \Session::flash('flash_message',[
                                                    'msg'=>'Produto adicionado!',
                                                    'class'=>'alert alert-success'
                                                    ]);
                    return response()->json(['success'=> true]);
                }
                else
                {
                    return response()->json(['success'=> false]);
                }
                //return response()->json(['success'=> $produto]);
                
            }
            //dd($carrinho);
        }
        else
        {
            if(isset($request->produto) && isset($request->quantidade) && $request->quantidade > 0)
            {
                if(!session_start()){session_start();}
                $quantidade = intval($request->quantidade);
                $produto = intval($request->produto);
                $_SESSION['pedido'][$produto]->pedido_itens->quantidade = $quantidade;
                return response()->json(['success'=> true]);
            }
            else
            {
                return response()->json(['success'=> false]);
            }
            //return view('carrinho.index');
        }
    }
    
    public function cancelar(Request $request)
    {
        
        if(auth()->check())
        {
            $user_id = auth()->user()->id;
            $user_tipo =auth()->user()->tipo;
            if($carrinho = \App\Pedido::find($request->id))
            {
                $data = self::dataHora();
                if($carrinho->status !== 'R')
                {
                    return response()->json(['success'=> false]);
                }
                elseif($carrinho->usuario_id == $user_id || $user_tipo == 'A')
                {
                    //$data = date('Y-m-d H-i-s');
                    $carrinho->status = 'C';
                    //$carrinho->data_hora_alterado = $data;
                    $carrinho->data_hora_cancelado = $data;
                    $carrinho->save();
                    \Session::flash('flash_message',[
                                            'msg'=>'Carrinho removido!',
                                            'class'=>'alert alert-success'
                                            ]);
                    return response()->json(['success'=> true]);
                }
                else
                {
                    Session::flash('flash_message',[
                                            'msg'=>'Carrinho não localizado!',
                                            'class'=>'alert alert-danger'
                                            ]);
                return response()->json(['success'=> false]);
                }
            }
            else
            {
                Session::flash('flash_message',[
                                            'msg'=>'Carrinho não localizado!',
                                            'class'=>'alert alert-danger'
                                            ]);
                //return redirect()->route('pedido.consultar');
                return response()->json(['success'=> false]);
            }
        }
        else
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Algo errado, faça o login novamente!',
                                            'class'=>'alert alert-danger'
                                            ]);
            //return redirect()->route('/login');
            return response()->json(['success'=> false]);
        }
    }
}
?>