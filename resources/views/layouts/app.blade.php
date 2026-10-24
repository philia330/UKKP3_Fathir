<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Pengaduan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f5f7fb; min-height: 100vh; }
        .navbar-brand { font-weight: 700; }
        .card { border: 0; box-shadow: 0 .15rem .6rem rgba(20, 40, 80, .08); }
        .stat-card { border-left: .3rem solid #0d6efd; }
        .page-title { font-weight: 700; }

        /* Sidebar: lebar tetap di layar besar, penuh di layar kecil */
        .sidebar { width: 100%; background: #0d6efd; }
        @media (min-width: 768px) {
            .sidebar { width: 250px; min-height: 100vh; flex-shrink: 0; }
        }
        .sidebar .nav-link { color: rgba(255, 255, 255, .85); border-radius: .4rem; padding: .6rem .9rem; }
        .sidebar .nav-link:hover { background: rgba(255, 255, 255, .15); color: #fff; }
        .sidebar .nav-link.active { background: #fff; color: #0d6efd; font-weight: 600; }
    </style>
</head>
<body>
    @auth
        {{-- SUDAH LOGIN: sidebar di kiri, konten di kanan --}}
        <div class="d-flex flex-column flex-md-row">
            <aside class="sidebar d-flex flex-column p-3 text-white">
                <a class="navbar-brand text-white fs-5 text-decoration-none" href="{{ route(auth()->user()->role.'.dashboard') }}">
                    <i class="bi bi-megaphone-fill me-2"></i>Pengaduan cafe
                </a>
                <hr>

                {{-- Menu sidebar, berbeda per role --}}
                <ul class="nav nav-pills flex-column mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('*.dashboard') ? 'active' : '' }}"
                           href="{{ route(auth()->user()->role.'.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                    </li>

                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}"
                               href="{{ route('admin.pengaduan.index') }}">
                                <i class="bi bi-inbox me-2"></i>Semua Pengaduan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                               href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people me-2"></i>Data User
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('customer.pengaduan.index') ? 'active' : '' }}"
                               href="{{ route('customer.pengaduan.index') }}">
                                <i class="bi bi-list-ul me-2"></i>Pengaduan Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('customer.pengaduan.create') ? 'active' : '' }}"
                               href="{{ route('customer.pengaduan.create') }}">
                                <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan
                            </a>
                        </li>
                    @endif
                </ul>

                {{-- Info user dan tombol logout --}}
                <div class="mt-md-auto">
                    <hr>
                    <div class="mb-2">
                        <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->nama }}
                        <div class="small opacity-75">{{ ucfirst(auth()->user()->role) }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-light btn-sm w-100" type="submit">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </button>
                    </form>
                </div>
            </aside>

            <main class="flex-grow-1 p-4">
    @else
        {{-- BELUM LOGIN (login/register): navbar sederhana --}}
        <nav class="navbar navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('login') }}">
                    <i class="bi bi-megaphone-fill me-2"></i>Pengaduan cafe
                </a>
            </div>
        </nav>

        <main class="container py-4">
    @endauth

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        {{-- Pesan error validasi --}}
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <strong>Periksa kembali data berikut:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Isi halaman dari tiap view --}}
        @yield('content')
    </main>

    @auth
        </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>