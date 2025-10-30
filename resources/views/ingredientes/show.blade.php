@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Ingrediente</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $ingrediente->id }}</p>
            <p><strong>Nome:</strong> {{ $ingrediente->nome }}</p>
            <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('ingredientes.edit', $ingrediente->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
