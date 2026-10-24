@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    .login-wrapper { min-height: calc(100vh - 140px); display: flex; align-items: center; }
    .login-card { border-radius: 1rem; box-shadow: 0 .5rem 1.5rem rgba(20, 40, 80, .12); }
    .login-icon {
        width: 64px; height: 64px; border-radius: 50%;
        background: #e7f0ff; color: #0d6efd; font-size: 1.8rem;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem;
    }
</style>

<div class="login-wrapper">
    <div class="row justify-content-center w-100 mx-0">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card login-card">
                <div class="card-body p-4 p-md-5">

                    <div class="login-icon"><i class="bi bi-shield-lock"></i></div>

                    <h1 class="h3 page-title text-center mb-1">Login</h1>
                    <p class="text-center text-muted mb-4">Masuk untuk melanjutkan</p>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input id="email" name="email" type="email" class="form-control"
                                       placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input id="password" name="password" type="password" class="form-control"
                                       placeholder="Masukkan password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Tampilkan password">
                                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-lg w-100" type="submit">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
                        </button>
                    </form>

                    <hr class="my-4">

                    <p class="text-center mb-0">Belum punya akun? <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">Daftar sebagai customer</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const icon = document.getElementById('togglePasswordIcon');
        const sedangTersembunyi = input.type === 'password';
        input.type = sedangTersembunyi ? 'text' : 'password';
        icon.className = sedangTersembunyi ? 'bi bi-eye-slash' : 'bi bi-eye';
    });
</script>

@endsection