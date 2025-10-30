@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ingredientes</h1>
    <a href="{{ route('ingredientes.create') }}" class="btn btn-primary mb-3">Adicionar Ingrediente</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ingredientes as $ingrediente)
            <tr>
                <td>{{ $ingrediente->id }}</td>
                <td>{{ $ingrediente->nome }}</td>
                <td>
                    <a href="{{ route('ingredientes.show', $ingrediente->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('ingredientes.edit', $ingrediente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('ingredientes.destroy', $ingrediente->id) }}" method="POST" class="d-inline">
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
