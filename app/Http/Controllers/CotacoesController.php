<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Helpers\Cotacoes;

class CotacoesController extends Controller{
    public function index(){
        $cotacoes = new Cotacoes();
        $link = '/api/moedas/moeda';
        $moedas = $cotacoes->moedas($link, "GET");
        $return = json_decode($moedas->getData());
        return view('cotacoes')->with('listaMoedas', $return);
    }

    public function convert(){
        $cotacoes = new Cotacoes();
        $link = '/api/moedas/cotacao/'.request()->moeda;
        $return = $cotacoes->cotacao($link, "GET");
        $data = json_decode($return->getData());
        $status = json_decode($return->getStatusCode());
        if($status == 500){
            return view('cotacoes.resultCotacao')->with("data", $data)->with("status", $status);
        }else if($status == 200){
            return view('cotacoes.resultCotacao')->with("data", $data)->with("status", $status);
        }
    }
}
