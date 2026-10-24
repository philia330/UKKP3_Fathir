@extends('layouts.app')

@section('title', 'Daftar Customer')

@section('content')

<style>
    .register-wrapper { min-height: calc(100vh - 140px); display: flex; align-items: center; }
    .register-card { border-radius: 1rem; box-shadow: 0 .5rem 1.5rem rgba(20, 40, 80, .12); }
    .register-icon {
        width: 64px; height: 64px; border-radius: 50%;
        background: #e7f0ff; color: #0d6efd; font-size: 1.8rem;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem;
    }
</style>

<div class="register-wrapper">
    <div class="row justify-content-center w-100 mx-0">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card register-card">
                <div class="card-body p-4 p-md-5">

                    <div class="register-icon"><i class="bi bi-person-plus"></i></div>

                    <h1 class="h3 page-title text-center mb-1">Daftar Customer</h1>
                    <p class="text-center text-muted mb-4">Buat akun untuk mengirim pengaduan</p>

                    {{-- Tidak ada kolom role, role diisi server --}}
                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input id="nama" name="nama" class="form-control"
                                       placeholder="Nama lengkap" value="{{ old('nama') }}" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input id="email" name="email" type="email" class="form-control"
                                       placeholder="nama@email.com" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor telepon <span class="text-muted">(opsional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input id="no_telp" name="no_telp" class="form-control"
                                       placeholder="08xxxxxxxxxx" value="{{ old('no_telp') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-muted">(minimal 8 karakter)</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input id="password" name="password" type="password" class="form-control"
                                       placeholder="Minimal 8 karakter" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="password" aria-label="Tampilkan password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Ulangi password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                       class="form-control" placeholder="Ketik ulang password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="password_confirmation" aria-label="Tampilkan password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-lg w-100" type="submit">
                            <i class="bi bi-person-check me-1"></i>Buat Akun
                        </button>
                    </form>

                    <hr class="my-4">

                    <p class="text-center mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(function (tombol) {
        tombol.addEventListener('click', function () {
            const input = document.getElementById(tombol.dataset.target);
            const icon = tombol.querySelector('i');
            const sedangTersembunyi = input.type === 'password';
            input.type = sedangTersembunyi ? 'text' : 'password';
            icon.className = sedangTersembunyi ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    });
</script>

@endsection