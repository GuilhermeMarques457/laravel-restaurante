@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Compras</h1>
    <a href="{{ route('compras.create') }}" class="btn btn-primary mb-3">Adicionar Compra</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nota Fiscal</th>
                <th>Data</th>
                <th>Quantidade</th>
                <th>Fornecedor</th>
                <th>Ingrediente</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compras as $compra)
            <tr>
                <td>{{ $compra->id }}</td>
                <td>{{ $compra->nota_fiscal }}</td>
                <td>{{ $compra->data_compra }}</td>
                <td>{{ $compra->quantidade }}</td>
                <td>{{ $compra->fornecedor->nome ?? '' }}</td>
                <td>{{ $compra->ingrediente->nome ?? '' }}</td>
                <td>
                    <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
