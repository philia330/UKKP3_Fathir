@extends('layouts.app')

@section('title', 'Buat Pengaduan')

@section('content')
<h1 class="h3 page-title mb-3">Buat Pengaduan</h1>

<div class="card">
    <div class="card-body">
        {{-- enctype multipart/form-data wajib untuk upload foto --}}
        <form action="{{ route('customer.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nomor meja: pilihan dari daftar hardcode di model --}}
            <div class="mb-3">
                <label for="no_meja" class="form-label">Nomor meja</label>
                <select id="no_meja" name="no_meja" class="form-select" required>
                    <option value="">Pilih nomor meja</option>
                    @foreach($mejas as $meja)
                        <option value="{{ $meja }}" @selected(old('no_meja') === $meja)>{{ $meja }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Kategori: pilihan dari daftar hardcode di model --}}
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" class="form-select" required>
                    <option value="">Pilih kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori }}" @selected(old('kategori') === $kategori)>{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="pengaduan" class="form-label">Isi pengaduan (minimal 10 karakter)</label>
                <textarea id="pengaduan" name="pengaduan" class="form-control" rows="5" required>{{ old('pengaduan') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto bukti <span class="text-muted">(opsional, JPG/PNG maksimal 2 MB)</span></label>
                <input id="foto" name="foto" type="file" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
            </div>

            <button class="btn btn-primary" type="submit"><i class="bi bi-send me-1"></i>Kirim Pengaduan</button>
            <a class="btn btn-secondary" href="{{ route('customer.pengaduan.index') }}">Kembali</a>
        </form>
    </div>
</div>
@endsection