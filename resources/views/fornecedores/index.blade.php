@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Fornecedores</h1>
    <a href="{{ route('fornecedores.create') }}" class="btn btn-primary mb-3">Adicionar Fornecedor</a>

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
            @foreach($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->id }}</td>
                <td>{{ $fornecedor->nome }}</td>
                <td>
                    <a href="{{ route('fornecedores.show', $fornecedor->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" class="d-inline">
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
