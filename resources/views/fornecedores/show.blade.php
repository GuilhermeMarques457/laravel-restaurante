@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Fornecedor</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $fornecedor->id }}</p>
            <p><strong>Nome:</strong> {{ $fornecedor->nome }}</p>
            <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
