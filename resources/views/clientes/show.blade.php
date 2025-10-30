@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Cliente</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $cliente->nome }}</h5>
            <p class="card-text"><strong>Endereço:</strong> {{ $cliente->endereco }}</p>
            <p class="card-text"><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
