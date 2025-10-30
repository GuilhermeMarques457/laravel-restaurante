@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pratos</h1>
    <a href="{{ route('pratos.create') }}" class="btn btn-primary mb-3">Adicionar Prato</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço Unitário</th>
                <th>Ingredientes</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pratos as $prato)
            <tr>
                <td>{{ $prato->id }}</td>
                <td>{{ $prato->nome }}</td>
                <td>R$ {{ number_format($prato->preco_unitario, 2, ',', '.') }}</td>
                <td>
                    @foreach($prato->ingredientes as $ing)
                        {{ $ing->nome }} ({{ $ing->pivot->quantidade }})<br>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('pratos.show', $prato->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('pratos.edit', $prato->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('pratos.destroy', $prato->id) }}" method="POST" class="d-inline">
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
