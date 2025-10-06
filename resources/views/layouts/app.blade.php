<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Utang</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_utang.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .navbar {
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
            color: #fff !important;
        }
        .navbar-nav .nav-link {
            color: #f8f9fa !important;
            font-weight: 500;
        }
        .navbar-nav .nav-link.active {
            color: #ffe082 !important;
        }
        .btn-logout {
            background: #ffc107;
            border: none;
            color: #212529;
            font-weight: 500;
        }
        .btn-logout:hover {
            background: #e0a800;
            color: #fff;
        }
        .card-custom {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
            border: none;
        }
        footer {
            margin-top: 40px;
            padding: 15px 0;
            text-align: center;
            background: #0d6efd;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @auth
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('debts.index') }}">
                <i class="bi bi-journal-text"></i> Catatan Utang
            </a>
            {{-- <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-journal-text"></i> Utang
            </a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('debts.*') ? 'active' : '' }}"
                           href="{{ route('debts.index') }}">
                           <i class="bi bi-list-ul"></i> Daftar Utang
                        </a>
                    </li> --}}
                    <li class="nav-item ms-2">
                        <a class="btn btn-logout" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth
    <!-- Content -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    @auth
    <footer>
        <p class="mb-0">© {{ date('Y') }} Catatan Utang - Ludfi Eric Fernando - 2025</p>
    </footer>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
