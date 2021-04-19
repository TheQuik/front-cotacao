@extends('adminlte::page')

@section('title', 'Dashboad')

@section('content_header')
    <h1>Conversor de Moedas</h1>
@stop

@section('content')
    <p>Bem vindo a cotações!</p>
    @php
        // dd($listaMoedas);
    @endphp
    <form id="frm-moeda">
        @csrf
        <div class="d-flex justify-content-center col-md-12">
            <div class="row">
                <div class="form-group col-md-10">
                    <label for="moeda">Moeda</label>
                    <select name="moeda" id="moeda" class="form-control">
                        <option value="">Escolha uma moeda</option>
                        @foreach ($listaMoedas as $item=>$v)
                            <option value="{{ $item }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class="col-md-12">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-center col-md-12">
        <div class="row">
            <div class="col-md-12" id="return-cotacao">


            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
@stop

@section('js')
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/cotacoes.js') }}"></script>
@stop
