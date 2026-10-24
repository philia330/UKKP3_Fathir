<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PengaduanController extends Controller
{
    // Daftar pengaduan milik customer yang login saja
    public function index()
    {
        $pengaduans = Pengaduan::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pengaduan.customer-index', compact('pengaduans'));
    }

    // Form buat pengaduan; pilihan kategori dan meja diambil dari model (hardcode)
    public function create()
    {
        return view('pengaduan.create', [
            'kategoris' => Pengaduan::KATEGORI,
            'mejas' => Pengaduan::daftarMeja(),
        ]);
    }

    // Simpan pengaduan. user_id dan status ditetapkan server, bukan dari form.
    public function store(Request $request)
    {
        $data = $request->validate([
            // Rule::in memastikan nilai harus salah satu dari daftar hardcode
            'kategori' => ['required', Rule::in(Pengaduan::KATEGORI)],
            'no_meja' => ['required', Rule::in(Pengaduan::daftarMeja())],
            'pengaduan' => ['required', 'string', 'min:10'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            // Disimpan di storage/app/public/foto, path-nya disimpan di database
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['status'] = 'menunggu';

        Pengaduan::create($data);

        return redirect()->route('customer.pengaduan.index')->with('success', 'Pengaduan berhasil dikirim.');
    }
}