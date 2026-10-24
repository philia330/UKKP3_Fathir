@extends('layouts.app')

@section('title', 'Semua Pengaduan')

@section('content')
<h1 class="h3 page-title mb-3">Semua Pengaduan</h1>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr><th>Tanggal</th><th>Customer</th><th>No Meja</th><th>Kategori</th><th>Isi</th><th>Foto</th><th>Status</th><th>Ubah Status</th></tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $pengaduan)
                    <tr>
                        <td>{{ $pengaduan->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $pengaduan->user->nama }}</td>
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
                        <td>
                            {{-- Form ubah status: method PUT lewat @method --}}
                            <form action="{{ route('admin.pengaduan.updateStatus', $pengaduan) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select form-select-sm" aria-label="Status pengaduan">
                                    @foreach(['menunggu', 'diproses', 'selesai'] as $status)
                                        <option value="{{ $status }}" @selected($pengaduan->status === $status)>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center">Belum ada pengaduan.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $pengaduans->links() }}
    </div>
</div>
@endsection