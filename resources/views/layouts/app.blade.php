<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinhaApp - @yield('title')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            min-width: 220px;
            max-width: 220px;
            background-color: #343a40;
            color: #fff;
            transition: all 0.3s;
        }

        .sidebar a {
            color: #ddd;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #495057;
            color: #fff;
            font-weight: bold;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .sidebar-header {
            font-size: 1.3rem;
            font-weight: bold;
            text-align: center;
            padding: 1rem 0;
            border-bottom: 1px solid #495057;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 220px;
            text-align: center;
            padding: 1rem 0;
            border-top: 1px solid #495057;
        }
    </style>
</head>
<body>
    @auth
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column position-relative">
        <div class="sidebar-header">
            <i class="fas fa-utensils"></i> MinhaApp
        </div>

        <nav class="nav flex-column mt-3">
            <a class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                <i class="fas fa-users"></i> Clientes
            </a>
            <a class="nav-link {{ request()->is('compras*') ? 'active' : '' }}" href="{{ route('compras.index') }}">
                <i class="fas fa-cart-shopping"></i> Compras
            </a>
            <a class="nav-link {{ request()->is('encomendas*') ? 'active' : '' }}" href="{{ route('encomendas.index') }}">
                <i class="fas fa-box-open"></i> Encomendas
            </a>
            <a class="nav-link {{ request()->is('fornecedores*') ? 'active' : '' }}" href="{{ route('fornecedores.index') }}">
                <i class="fas fa-truck"></i> Fornecedores
            </a>
            <a class="nav-link {{ request()->is('ingredientes*') ? 'active' : '' }}" href="{{ route('ingredientes.index') }}">
                <i class="fas fa-carrot"></i> Ingredientes
            </a>
            <a class="nav-link {{ request()->is('pratos*') ? 'active' : '' }}" href="{{ route('pratos.index') }}">
                <i class="fas fa-bowl-food"></i> Pratos
            </a>
        </nav>

        <div class="sidebar-footer">
            &copy; {{ date('Y') }} MinhaApp
        </div>
    </div>
    @endauth

    <!-- Main Content -->
    <div class="content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
            <div class="container-fluid">
                @auth
                    <span class="navbar-brand mb-0 h1">@yield('title')</span>
                    <div class="d-flex ms-auto align-items-center">
                        <span class="me-3"><i class="fas fa-user"></i> {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a class="navbar-brand mb-0 h1" href="{{ route('login') }}">MinhaApp</a>
                    <div class="d-flex ms-auto">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-success">Registrar</a>
                    </div>
                @endauth
            </div>
        </nav>

        <!-- Content Section -->
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
