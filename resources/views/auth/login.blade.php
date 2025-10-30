@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <div class="text-center mb-4">
            <i class="fas fa-utensils fa-3x text-primary"></i>
            <h2 class="mt-2">MinhaApp Restaurante</h2>
            <p class="text-muted">Faça login para acessar o sistema</p>
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

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-envelope me-2"></i>E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="seu@email.com" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fas fa-lock me-2"></i>Senha</label>
                <input type="password" name="password" class="form-control" placeholder="********" required>
            </div>

            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sign-in-alt me-2"></i>Entrar</button>
        </form>

        <div class="mt-3 text-center">
            <span>Não tem conta? <a href="{{ route('register') }}">Registrar</a></span>
        </div>
    </div>
</div>
@endsection
