<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $carrinho = \App\Pedido::where('usuario_id',auth()->user()->id)->where('status','R')->get();
        if(count($carrinho) > 0)
        {
            return view('perfil.index', compact('carrinho'));
        }
        else
        {
            return view('perfil.index');
        }
        return view('perfil.index');
    }
    
    public function grafico()
    {
        return view('relatorio.grafico');
    }
}
