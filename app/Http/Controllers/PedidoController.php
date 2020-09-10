<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function consultar()
    {
        if(auth()->user()->tipo === 'A')
        {
            return view('pedido.consultar');
        }
        else
        {
            return view('perfil.index');
        }
    }
    
    public function exibir(Request $request)
    {
        if(!empty($request->codigo))
        {
            if($carrinho[] = \App\Pedido::find($request->codigo))
            {
                return view('pedido.consultar', compact('carrinho'));
            }
            else
            {
                \Session::flash('flash_message',[
                                            'msg'=>'Pedido não encontrado.',
                                            'class'=>'alert alert-danger'
                                            ]);
                return view('pedido.consultar');
            }
        }
        elseif(!empty($request->email))
        {
            $cliente = \App\User::where('email',$request->email)->get();
            if(count($cliente) > 0)
            {
                $carrinho = \App\Pedido::where('usuario_id',$cliente[0]->id)->get();
                if(count($carrinho) > 0)
                {
                    return view('pedido.consultar', compact('carrinho'));
                }
                else
                {
                    Session::flash('flash_message',[
                                            'msg'=>'Pedido não encontrado.',
                                            'class'=>'alert alert-danger'
                                            ]);
                    return view('pedido.consultar');
                }
            }
            else
            {
                \Session::flash('flash_message',[
                                            'msg'=>'E-mail não encontrado.',
                                            'class'=>'alert alert-danger'
                                            ]);
                return view('pedido.consultar');
            }
            return view('pedido.consultar', compact('carrinho'));
        }
        else
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Não foi possível realizar a pesquisa.',
                                            'class'=>'alert alert-danger'
                                            ]);
            return view('pedido.consultar');
        }
    }
}
