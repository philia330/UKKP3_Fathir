@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<h1 class="h3 page-title mb-3">Tambah User</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input id="nama" name="nama" class="form-control" value="{{ old('nama') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label">Nomor telepon <span class="text-muted">(opsional)</span></label>
                <input id="no_telp" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
            </div>

            {{-- Admin boleh memilih role: admin atau customer --}}
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="">Pilih role</option>
                    @foreach(['admin' => 'Admin', 'customer' => 'Customer'] as $nilai => $label)
                        <option value="{{ $nilai }}" @selected(old('role') === $nilai)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password <span class="text-muted">(minimal 8 karakter)</span></label>
                <input id="password" name="password" type="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Ulangi password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
            </div>

            <button class="btn btn-primary" type="submit"><i class="bi bi-save me-1"></i>Simpan</button>
            <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Kembali</a>
        </form>
    </div>
</div>
@endsection