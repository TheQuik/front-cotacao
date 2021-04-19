<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\Login;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    /**
     * Validando o login na aplicação
     * @param Request
     *
     * @return dashboard|login
     */
    public function login(){
        $messages = [
            'required' => 'O :attribute é obrigatório.',
            'max' => 'O :attribute Não pode ultrapassar :max.',
            'min' => "O :attribute tem que ser maior que :min."
        ];

        $validator = Validator::make(request()->all(), [
            'email'=>'required|string|email|max:255',
            'password'=>'required|string|min:6',
        ], $messages);

        if($validator->fails()){
            return redirect('login')
                        ->withErrors($validator)
                        ->withInput();
        }


        $credentials = request()->only('email', 'password');

        $login = new Login();
        $return = $login->login(json_encode($credentials));
        $data = json_decode($return->getData());
        $status = json_decode($return->getStatusCode());

        if($status == 500){
            return back()->withErrors([
                'no_login' => 'Houve um erro ao logar, tente novamente!',
            ]);
        }else if($status == 401){
            return back()->withErrors([
                'no_login' => $data->error,
            ]);
        }else if($status == 200){
            $logged = $login->me($data->access_token);
            $me = json_decode($logged->getData());
            // dd($data->expire);
            session(['email' => $me->email, 'id' => $me->id, 'name' => $me->name,'active' => 1, 'email_verified_at' => $me->email_verified_at, 'created_at' => $me->created_at, 'access_token' => $data->access_token, 'access_expires_in' => $data->access_expires_in, 'refresh_token' => $data->refresh_token, 'expire' => $data->expire]);
            if (session()) {
                return redirect("/");
            }
        }
    }

    public function register(){

        $messages = [
            'required' => 'O :attribute é obrigatório.',
            'max' => 'O :attribute Não pode ultrapassar :max.',
            'min' => "O :attribute tem que ser maior que :min.",
            'confirmed'=> "A confirmação da senha deve ser igual a senha!"
        ];

        $validator = Validator::make(request()->all(), [
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255',
            'password'=>'required|string|min:6|confirmed',
        ], $messages);

        if($validator->fails()){
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $credentials = request()->only('name', 'email', 'password', 'password_confirmation');

        $login = new Login();
        $return = $login->register(json_encode($credentials));
        $data = json_decode($return->getData());
        $status = json_decode($return->getStatusCode());

        if($status == 500){
            return back()->withErrors([
                'no_login' => 'Houve um erro ao cadastrar o usuário, tente novamente!',
            ]);
        }else if($status == 400){
            return back()->withErrors($data->error);
        }else if($status == 200){
            return redirect('login')->withInput();
        }
    }

    public function me(){

    }
}
