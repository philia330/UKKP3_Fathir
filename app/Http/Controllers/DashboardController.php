<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard admin: melihat semua data
    public function admin()
    {
        return view('dashboard.admin', [
            'totalCustomers' => User::where('role', 'customer')->count(),
            'totalPengaduan' => Pengaduan::count(),
            'menunggu' => Pengaduan::where('status', 'menunggu')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
            'recentPengaduan' => Pengaduan::with('user')->latest()->take(5)->get(),
        ]);
    }

    // Dashboard customer: hanya data milik user yang login
    public function customer()
    {
        $query = Pengaduan::where('user_id', Auth::id());

        return view('dashboard.customer', [
            'totalPengaduan' => (clone $query)->count(),
            'menunggu' => (clone $query)->where('status', 'menunggu')->count(),
            'diproses' => (clone $query)->where('status', 'diproses')->count(),
            'selesai' => (clone $query)->where('status', 'selesai')->count(),
            'recentPengaduan' => (clone $query)->latest()->take(5)->get(),
        ]);
    }
}