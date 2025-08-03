<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus terdiri dari minimal 6 karakter',
        ]);

        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        // Cegah brute-force dengan Rate Limiting
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam $seconds detik.",
            ]);
        }

        // Coba ambil user dari email
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            RateLimiter::hit($throttleKey, 60); // Tambah percobaan (1 menit)
            return back()->withErrors([
                'email' => $user
                    ? 'Password salah.'
                    : 'Email tidak terdaftar.',
            ])->withInput();
        }

        // Login aman via Auth::login
        Auth::login($user);

        RateLimiter::clear($throttleKey); // Reset hit kalau sukses

        return redirect()->route('dashboard.index')->with('success', 'Selamat datang, ' . $user->name . '!');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Hapus autentikasi user

        $request->session()->invalidate(); // Hancurkan semua session data
        $request->session()->regenerateToken(); // Regenerasi token CSRF untuk keamanan

        return redirect()->route('login')->with('status', 'Anda telah logout.');
    }
}
