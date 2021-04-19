@extends('adminlte::page')

@section('title', 'Dashboad')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')
    <p>Bem vindo!.</p>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
@stop

@section('js')
    <script src="{{ secure_asset('/js/app.js') }}"></script>
@stop
