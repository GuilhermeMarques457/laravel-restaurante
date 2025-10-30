@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Compra</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('compras.update', $compra->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nota Fiscal</label>
            <input type="text" name="nota_fiscal" class="form-control" value="{{ old('nota_fiscal', $compra->nota_fiscal) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Data da Compra</label>
            <input type="date" name="data_compra" class="form-control" value="{{ old('data_compra', $compra->data_compra) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Quantidade</label>
            <input type="number" name="quantidade" class="form-control" value="{{ old('quantidade', $compra->quantidade) }}" required min="1">
        </div>
        <div class="mb-3">
            <label class="form-label">Fornecedor</label>
            <select name="fornecedor_id" class="form-control" required>
                @foreach($fornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}" {{ $compra->fornecedor_id == $fornecedor->id ? 'selected' : '' }}>
                        {{ $fornecedor->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ingrediente</label>
            <select name="ingrediente_id" class="form-control" required>
                @foreach($ingredientes as $ingrediente)
                    <option value="{{ $ingrediente->id }}" {{ $compra->ingrediente_id == $ingrediente->id ? 'selected' : '' }}>
                        {{ $ingrediente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
