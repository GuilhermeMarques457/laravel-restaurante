@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes da Compra</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nota Fiscal:</strong> {{ $compra->nota_fiscal }}</p>
            <p><strong>Data da Compra:</strong> {{ $compra->data_compra }}</p>
            <p><strong>Quantidade:</strong> {{ $compra->quantidade }}</p>
            <p><strong>Fornecedor:</strong> {{ $compra->fornecedor->nome ?? '' }}</p>
            <p><strong>Ingrediente:</strong> {{ $compra->ingrediente->nome ?? '' }}</p>

            <a href="{{ route('compras.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
