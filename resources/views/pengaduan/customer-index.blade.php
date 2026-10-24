@extends('layouts.app')

@section('title', 'Pengaduan Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 page-title mb-0">Pengaduan Saya</h1>
    <a class="btn btn-primary" href="{{ route('customer.pengaduan.create') }}"><i class="bi bi-plus-circle me-1"></i>Buat Pengaduan</a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle">
            <thead><tr><th>Tanggal</th><th>No Meja</th><th>Kategori</th><th>Isi</th><th>Foto</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($pengaduans as $pengaduan)
                    <tr>
                        <td>{{ $pengaduan->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $pengaduan->no_meja }}</td>
                        <td>{{ $pengaduan->kategori }}</td>
                        <td>{{ $pengaduan->pengaduan }}</td>
                        <td>
                            @if($pengaduan->foto)
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($pengaduan->foto) }}" target="_blank" rel="noopener">Lihat foto</a>
                            @else
                                -
                            @endif
                        </td>
                        <td><span class="badge text-bg-secondary">{{ ucfirst($pengaduan->status) }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Belum ada pengaduan.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $pengaduans->links() }}
    </div>
</div>
@endsection