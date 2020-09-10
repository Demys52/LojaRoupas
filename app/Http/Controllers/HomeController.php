<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $produtos = \App\Produto::all();
        //$ofertas = $produtos->groupBy('modelo');
        //dd($produto);
        return view('welcome', compact('produtos'));
    }
}
