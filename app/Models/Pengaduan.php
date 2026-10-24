<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    // KATEGORI HARDCODE: ubah/tambah pilihan kategori di sini saja
    public const KATEGORI = [
        'Pelayanan',
        'Makanan',
        'Minuman',
        'Kebersihan',
        'Fasilitas',
        'Lainnya',
    ];

    // NO MEJA HARDCODE: Meja 1 sampai Meja 15 (ubah angka 15 untuk menambah/mengurangi)
    public static function daftarMeja(): array
    {
        return array_map(fn ($n) => 'Meja '.$n, range(1, 15));
    }

    protected $fillable = [
        'user_id',
        'kategori',
        'no_meja',
        'pengaduan',
        'foto',
        'status',
    ];

    // Setiap pengaduan dimiliki satu user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}