<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    // Admin melihat semua pengaduan
    public function index()
    {
        $pengaduans = Pengaduan::with('user')->latest()->paginate(10);

        return view('pengaduan.admin-index', compact('pengaduans'));
    }

    // Ubah status; hanya tiga nilai yang sah
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $data = $request->validate([
            'status' => ['required', 'in:menunggu,diproses,selesai'],
        ]);

        $pengaduan->update($data);

        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}