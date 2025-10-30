@extends('layouts.app')
@section('title', 'Detalhes da Encomenda')

@section('content')
<div class="container">
    <h1>Detalhes da Encomenda</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $encomenda->id }}</p>
            <p><strong>Número:</strong> {{ $encomenda->numero }}</p>
            <p><strong>Cliente:</strong> {{ $encomenda->cliente->nome }}</p>
            <p><strong>Pratos:</strong></p>
            <ul>
                @foreach($encomenda->pratos as $prato)
                    <li>{{ $prato->nome }} ({{ $prato->pivot->quantidade }})</li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('encomendas.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
    <a href="{{ route('encomendas.edit', $encomenda->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
</div>
@endsection
