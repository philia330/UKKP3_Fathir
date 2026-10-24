@extends('layouts.app')

@section('title', 'Dashboard Customer')

@section('content')
<h1 class="h3 page-title mb-4">Dashboard Customer</h1>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3"><div class="card stat-card"><div class="card-body d-flex justify-content-between align-items-center"><div><div class="text-muted">Pengaduan Saya</div><div class="fs-2">{{ $totalPengaduan }}</div></div><i class="bi bi-chat-left-text fs-1 text-primary"></i></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card stat-card"><div class="card-body d-flex justify-content-between align-items-center"><div><div class="text-muted">Menunggu</div><div class="fs-2">{{ $menunggu }}</div></div><i class="bi bi-hourglass-split fs-1 text-warning"></i></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card stat-card"><div class="card-body d-flex justify-content-between align-items-center"><div><div class="text-muted">Diproses</div><div class="fs-2">{{ $diproses }}</div></div><i class="bi bi-gear fs-1 text-info"></i></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card stat-card"><div class="card-body d-flex justify-content-between align-items-center"><div><div class="text-muted">Selesai</div><div class="fs-2">{{ $selesai }}</div></div><i class="bi bi-check-circle fs-1 text-success"></i></div></div></div>
</div>

<a class="btn btn-primary mb-4" href="{{ route('customer.pengaduan.create') }}"><i class="bi bi-plus-circle me-1"></i>Buat Pengaduan</a>

<div class="card">
    <div class="card-header bg-white fw-bold"><i class="bi bi-clock-history me-2"></i>Laporan Terbaru Saya</div>
    <div class="card-body table-responsive">
        @if($recentPengaduan->isEmpty())
            <p class="text-muted mb-0">Anda belum mengirim pengaduan.</p>
        @else
            <table class="table table-striped align-middle">
                <thead><tr><th>Tanggal</th><th>No Meja</th><th>Kategori</th><th>Isi</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach($recentPengaduan as $pengaduan)
                        <tr>
                            <td>{{ $pengaduan->created_at->format('d-m-Y') }}</td>
                            <td>{{ $pengaduan->no_meja }}</td>
                            <td>{{ $pengaduan->kategori }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($pengaduan->pengaduan, 50) }}</td>
                            <td><span class="badge text-bg-secondary">{{ ucfirst($pengaduan->status) }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection