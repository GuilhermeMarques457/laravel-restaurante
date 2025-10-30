@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Prato</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nome:</strong> {{ $prato->nome }}</p>
            <p><strong>Preço Unitário:</strong> R$ {{ number_format($prato->preco_unitario, 2, ',', '.') }}</p>
            <p><strong>Ingredientes:</strong></p>
            <ul>
                @foreach($prato->ingredientes as $ing)
                    <li>{{ $ing->nome }} ({{ $ing->pivot->quantidade }})</li>
                @endforeach
            </ul>

            <a href="{{ route('pratos.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('pratos.edit', $prato->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
