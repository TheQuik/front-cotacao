<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class Login extends Controller {

    public function __construct(){
        $this->middleware('auth', ['except'=>['login', 'register']]);
        $this->api_url = Config::get('app.api_url');
    }

    public function apiSend($link, $method, $payload, $token = null){
        $ch = curl_init($this->api_url.$link);
        $header=[
            'Content-Type:application/json'
        ];
        if($link == "/api/auth/me"){
            $header[] = "Authorization: Bearer ".$token;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $res = curl_exec($ch);
        $info = curl_getinfo($ch);
        $errno = curl_errno($ch);
        curl_close($ch);
        if($errno){
            $info['http_code'] = 500;
        }
        return response()->json($res, $info['http_code']);
    }

    public function login($credentials){
        $payload = null;
        if($credentials)
            $payload = $credentials;

        $response = $this->apiSend("/api/auth/login", "POST", $payload);

        return $response;

    }
    public function register($credentials){
        $payload = null;
        if($credentials)
            $payload = $credentials;

        $response = $this->apiSend("/api/auth/register", "POST", $payload);

        return $response;
    }


    public function me($access_token){
        $response = $this->apiSend("/api/auth/me", "POST", '', $access_token);

        return $response;
    }
}
