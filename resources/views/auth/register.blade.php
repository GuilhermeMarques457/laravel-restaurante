@extends('layouts.app')
@section('title', 'Registrar')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <div class="text-center mb-4">
            <i class="fas fa-utensils fa-3x text-success"></i>
            <h2 class="mt-2">MinhaApp Restaurante</h2>
            <p class="text-muted">Crie sua conta para acessar o sistema</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-user me-2"></i>Nome</label>
                <input type="text" name="name" class="form-control" placeholder="Seu nome completo" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fas fa-envelope me-2"></i>E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="seu@email.com" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fas fa-lock me-2"></i>Senha</label>
                <input type="password" name="password" class="form-control" placeholder="********" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fas fa-lock me-2"></i>Confirmar Senha</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="********" required>
            </div>

            <button type="submit" class="btn btn-success w-100"><i class="fas fa-user-plus me-2"></i>Registrar</button>
        </form>

        <div class="mt-3 text-center">
            <span>Já tem uma conta? <a href="{{ route('login') }}">Entrar</a></span>
        </div>
    </div>
</div>
@endsection
