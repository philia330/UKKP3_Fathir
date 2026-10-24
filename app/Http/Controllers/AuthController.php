<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Halaman login (GET /login)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login (POST /login)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'Email atau password tidak sesuai.'])
                ->onlyInput('email');
        }

        // Ganti ID sesi untuk mencegah session fixation
        $request->session()->regenerate();

        // Arahkan sesuai role
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
            default => abort(403, 'Role akun tidak dikenali.'),
        };
    }

    // Halaman register (GET /register)
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register (POST /register). Role selalu customer, ditulis di server.
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'no_telp' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_telp' => $validated['no_telp'] ?? null,
            'role' => 'customer',
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    // Logout (POST /logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}