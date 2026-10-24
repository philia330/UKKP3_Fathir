@extends('layouts.app')

@section('title', 'Data User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 page-title mb-0">Data User</h1>
    <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
        <i class="bi bi-person-plus me-1"></i>Tambah User
    </a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr><th>No</th><th>Nama</th><th>Email</th><th>No. Telepon</th><th>Role</th><th>Dibuat</th></tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        {{-- Nomor urut yang tetap benar di halaman 2, 3, dst. --}}
                        <td>{{ $users->firstItem() + $loop->index }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->no_telp ?? '-' }}</td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge text-bg-danger">Admin</span>
                            @else
                                <span class="badge text-bg-success">Customer</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Belum ada user.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection