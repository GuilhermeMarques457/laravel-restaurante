@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Prato</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('pratos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Preço Unitário</label>
            <input type="number" step="0.01" name="preco_unitario" class="form-control" value="{{ old('preco_unitario') }}" required>
        </div>

        <h5>Ingredientes</h5>
        @foreach($ingredientes as $i => $ingrediente)
        <div class="row mb-2">
            <div class="col-8">
                <input type="checkbox" name="ingredientes[]" value="{{ $ingrediente->id }}" id="ing{{ $ingrediente->id }}">
                <label for="ing{{ $ingrediente->id }}">{{ $ingrediente->nome }}</label>
            </div>
            <div class="col-4">
                <input type="number" name="quantidades[]" class="form-control" min="1" value="1" placeholder="Qtd">
            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('pratos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
