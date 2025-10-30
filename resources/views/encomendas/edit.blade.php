@extends('layouts.app')
@section('title', 'Editar Encomenda')

@section('content')
<div class="container">
    <h1>Editar Encomenda</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('encomendas.update', $encomenda->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Número da Encomenda</label>
            <input type="text" name="numero" class="form-control" value="{{ old('numero', $encomenda->numero) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="cliente_id" class="form-control" required>
                <option value="">Selecione o cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $encomenda->cliente_id) == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pratos</label>
            <div id="pratos-container">
                @foreach($encomenda->pratos as $prato)
                <div class="d-flex mb-2">
                    <select name="pratos[]" class="form-control me-2" required>
                        <option value="">Selecione um prato</option>
                        @foreach($pratos as $p)
                            <option value="{{ $p->id }}" {{ $p->id == $prato->id ? 'selected' : '' }}>{{ $p->nome }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="quantidades[]" class="form-control me-2" min="1" value="{{ $prato->pivot->quantidade }}" required>
                    <button type="button" class="btn btn-danger btn-remove"><i class="fas fa-trash"></i></button>
                </div>
                @endforeach
            </div>
            <button type="button" id="add-prato" class="btn btn-secondary mt-2"><i class="fas fa-plus"></i> Adicionar Prato</button>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('encomendas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    document.getElementById('add-prato').addEventListener('click', function() {
        let container = document.getElementById('pratos-container');
        let newRow = container.children[0].cloneNode(true);
        newRow.querySelectorAll('input, select').forEach(el => el.value = '');
        container.appendChild(newRow);
        newRow.querySelector('.btn-remove').addEventListener('click', function() {
            newRow.remove();
        });
    });

    document.querySelectorAll('.btn-remove').forEach(btn => {
        btn.addEventListener('click', function() {
            btn.closest('div.d-flex').remove();
        });
    });
</script>
@endsection
