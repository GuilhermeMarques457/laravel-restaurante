@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="text-center">
    <h1>Bem-vindo ao MinhaApp Restaurante!</h1>
    <p>Use o menu lateral para navegar entre os módulos.</p>
    @auth
        <p>Olá, {{ Auth::user()->name }}!</p>
    @else
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-success">Registrar</a>
    @endauth
</div>
@endsection
