@extends('layouts.app')
@section('title', 'Encomendas')

@section('content')
<div class="container">
    <h1>Encomendas</h1>
    <a href="{{ route('encomendas.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Adicionar Encomenda
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Cliente</th>
                <th>Pratos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($encomendas as $encomenda)
            <tr>
                <td>{{ $encomenda->id }}</td>
                <td>{{ $encomenda->numero }}</td>
                <td>{{ $encomenda->cliente->nome }}</td>
                <td>
                    @foreach($encomenda->pratos as $prato)
                        {{ $prato->nome }} ({{ $prato->pivot->quantidade }})<br>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('encomendas.show', $encomenda->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Ver
                    </a>
                    <a href="{{ route('encomendas.edit', $encomenda->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('encomendas.destroy', $encomenda->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">
                            <i class="fas fa-trash"></i> Deletar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
