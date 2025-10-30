@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Prato</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('pratos.update', $prato->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $prato->nome) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Preço Unitário</label>
            <input type="number" step="0.01" name="preco_unitario" class="form-control" value="{{ old('preco_unitario', $prato->preco_unitario) }}" required>
        </div>

        <h5>Ingredientes</h5>
        @foreach($ingredientes as $i => $ingrediente)
        <div class="row mb-2">
            <div class="col-8">
                <input type="checkbox" name="ingredientes[]" value="{{ $ingrediente->id }}" id="ing{{ $ingrediente->id }}"
                {{ $prato->ingredientes->contains($ingrediente->id) ? 'checked' : '' }}>
                <label for="ing{{ $ingrediente->id }}">{{ $ingrediente->nome }}</label>
            </div>
            <div class="col-4">
                <input type="number" name="quantidades[]" class="form-control" min="1"
                value="{{ $prato->ingredientes->contains($ingrediente->id) ? $prato->ingredientes->find($ingrediente->id)->pivot->quantidade : 1 }}">
            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('pratos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
