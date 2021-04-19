<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config, Session;

class Cotacoes extends Controller {

    public function __construct(){
        $this->middleware('auth');
        $this->api_url = Config::get('app.api_url');
    }


    public function apiSend($link, $method, $value=null){
        $ch = curl_init($this->api_url.$link.$value);
        $header=[
            'Content-Type:application/json'
        ];
        $header[] = "Authorization: Bearer ".Session::get('access_token');

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $res = curl_exec($ch);
        $info = curl_getinfo($ch);
        $errno = curl_errno($ch);
        curl_close($ch);
        if($errno){
            $info['http_code'] = 500;
        }
        return response()->json($res, $info['http_code']);
    }

    public function moedas($link, $method){
        $moedas = $this->apiSend($link, $method);
        return $moedas;
    }

    public function cotacao($link, $method){
        $cotacao = $this->apiSend($link, $method);
        
        return $cotacao;
    }
}
